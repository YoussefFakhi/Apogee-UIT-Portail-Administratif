<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'nullable|boolean'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $request->boolean('is_admin')
        ]);

        Activity::create([
            'user_id' => auth()->id(),
            'description' => 'Created new user: ' . $user->name,
            'type' => 'user_creation'
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Prevent self-demotion
        if ($user->id === auth()->id() && !$request->boolean('is_admin')) {
            return back()->with('error', 'You cannot remove your own admin status!');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'is_admin' => 'sometimes|boolean'
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_admin' => $request->boolean('is_admin')
        ]);

        Activity::create([
            'user_id' => auth()->id(),
            'description' => sprintf(
                'Updated user %s (Admin status: %s → %s)',
                $user->name,
                $user->is_admin ? 'Yes' : 'No',
                $request->boolean('is_admin') ? 'Yes' : 'No'
            ),
            'type' => 'user_update'
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();

        Activity::create([
            'user_id' => auth()->id(),
            'description' => 'Deleted user: ' . $user->name,
            'type' => 'user_deletion'
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }
}
