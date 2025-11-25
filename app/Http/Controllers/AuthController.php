<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->handlePostLoginRedirect(Auth::user());
        }
        return view('forms.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Extract names from email
        $names = $this->extractNamesFromEmail($request->email);

        // Try to authenticate existing user
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            $this->storeUserSession($user, $names['first'], $names['last']);

            // Redirect based on profile completeness
            return empty($user->fonction)
                ? redirect('/registrationp')->with('email', $user->email)
                : redirect('/profile');
        }

        // Handle new user
        if (!User::where('email', $request->email)->exists()) {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $names['first'].' '.$names['last']
            ]);

            Auth::login($user);
            return redirect('/registrationp')
                   ->with([
                       'email' => $request->email,
                       'prenom' => $names['first'],
                       'nom' => $names['last']
                   ]);
        }

        // Existing user but wrong password
        return back()->withErrors(['password' => 'Mot de passe incorrect']);
    }

    protected function handlePostLoginRedirect($user)
    {
        return empty($user->fonction)
            ? redirect('/registrationp')
            : redirect('/profile');
    }

    protected function storeUserSession($user, $prenom, $nom)
    {
        Session::put([
            'user_id' => $user->id,
            'email' => $user->email,
            'prenom' => $prenom,
            'nom' => $nom,
            'authenticated' => true
        ]);
    }

    private function extractNamesFromEmail($email)
    {
        $username = strtok($email, '@');
        $cleaned = preg_replace('/[._-]/', ' ', $username);
        $parts = explode(' ', $cleaned);

        return [
            'first' => ucfirst($parts[0] ?? 'Utilisateur'),
            'last' => ucfirst($parts[1] ?? '')
        ];
    }
}
