<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        // Verify authentication or session data exists
        if (!Auth::check() && !session()->has('registration_email')) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter d\'abord');
        }

        // Extract names from email
        $email = Auth::check() ? Auth::user()->email : session('registration_email');
        $names = $this->extractNamesFromEmail($email);

        // Get existing user data if available
        $user = Auth::user();

        return view('forms.enregistrerp', [
            'schools' => School::all(),
            'emailUser' => $email,
            'prenom' => $this->formatName($names['first']),
            'nom' => $this->formatName($names['last']),
            'fonction' => $user->fonction ?? '',
            'tele' => $user->tele ?? '',
            'userName' => $user->userName ?? '',
            'mac' => $user->mac ?? '',
            'school_id' => $user->school_id ?? old('school_id'),
            'strg1' => $user->strg1 ?? '',
            'strg2' => $user->strg2 ?? '',
            'strg3' => $user->strg3 ?? '',
            'strg4' => $user->strg4 ?? '',
            'p1' => $user->p1 ?? false,
            'p2' => $user->p2 ?? false,
            'p3' => $user->p3 ?? false,
            'p4' => $user->p4 ?? false,
            'p5' => $user->p5 ?? false,
            'p6' => $user->p6 ?? false,
            'p7' => $user->p7 ?? false,
            'p8' => $user->p8 ?? false,
            'p9' => $user->p9 ?? false,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_id' => 'required|exists:schools,id',
            'emailUser' => 'required|email|unique:users,email,'.Auth::id(),
            'fonction' => 'required|string|max:255',
            'tele' => 'required|string|max:20',
            'userName' => 'required|string|max:255',
            'mac' => 'required|string|max:255|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
            'strg1' => 'required|string',
            'strg2' => 'required|string',
            'strg3' => 'required|string',
            'strg4' => 'required|string',
        ], [
            'mac.regex' => 'L\'adresse MAC doit être au format 00:1A:2B:3C:4D:5E',
            'required' => 'Le champ :attribute est obligatoire',
        ]);

        // Get names from email (can't be changed)
        $email = Auth::check() ? Auth::user()->email : session('registration_email');
        $names = $this->extractNamesFromEmail($email);

        $userData = [
            'name' => $this->formatName($names['first']).' '.$this->formatName($names['last']),
            'email' => $validated['emailUser'],
            'fonction' => $validated['fonction'],
            'tele' => $validated['tele'],
            'userName' => $validated['userName'],
            'mac' => $validated['mac'],
            'school_id' => $validated['school_id'],
            'strg1' => $validated['strg1'],
            'strg2' => $validated['strg2'],
            'strg3' => $validated['strg3'],
            'strg4' => $validated['strg4'],
            'p1' => $request->has('p1'),
            'p2' => $request->has('p2'),
            'p3' => $request->has('p3'),
            'p4' => $request->has('p4'),
            'p5' => $request->has('p5'),
            'p6' => $request->has('p6'),
            'p7' => $request->has('p7'),
            'p8' => $request->has('p8'),
            'p9' => $request->has('p9'),
        ];

        if (Auth::check()) {
            Auth::user()->update($userData);
        } else {
            $userData['password'] = Hash::make(Str::random(12));
            $user = User::create($userData);
            Auth::login($user);
            Session::forget('registration_email');
        }

        return redirect('/profile')->with('success', 'Profil enregistré avec succès!');
    }

    private function extractNamesFromEmail($email)
    {
        $username = strtolower(explode('@', $email)[0] ?? 'utilisateur');

        foreach (['.', '_', '-'] as $delimiter) {
            if (str_contains($username, $delimiter)) {
                $parts = explode($delimiter, $username, 2);
                return [
                    'first' => $parts[0] ?? 'utilisateur',
                    'last' => $parts[1] ?? ''
                ];
            }
        }

        return [
            'first' => $username,
            'last' => ''
        ];
    }

    private function formatName($name)
    {
        return $name ? ucfirst(trim($name)) : '';
    }
}
