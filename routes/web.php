<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Models\User;
use App\Models\School;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\PDFRequestController;

/*
|--------------------------------------------------------------------------
| Public Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('portal.index');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Require Authentication)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'sessionCheck'])->group(function () {
    // Registration Routes
    Route::get('/registrationp', [RegistrationController::class, 'showRegistrationForm'])
         ->name('registration.form');
    Route::post('/registrationp', [RegistrationController::class, 'store'])
         ->name('registration.submit');

    // Profile Route
    Route::get('/profile', function () {
        $user = User::with(['school', 'activities' => function($query) {
            $query->latest()->take(10);
        }])->findOrFail(auth()->id());

        return view('forms.profile', [
            'user' => $user,
            'activities' => $user->activities
        ]);
    })->name('profile');

    // Module Results
    Route::get('/insertion-resultat-module', function () {
        return view('forms.insertion-resultat-module');
    })->name('module.results');

    Route::get('/inscription-annee-anterieure', function () {
        return view('forms.inscription-annee-anterieure');
    })->name('previous.year.registration');

    Route::get('/compte-fonctionnel-apogee', function () {
        return view('forms.compte-fonctionnel-apogee');
    })->name('functional.account');

    Route::get('/insertion-resultat-etudiant', function () {
        return view('forms.insertion-resultat-etudiant');
    })->name('student.results');
});

/*
|--------------------------------------------------------------------------
| Logout Route
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    Session::flush();
    return redirect()->route('login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Debug/Setup Routes (Remove in Production)
|--------------------------------------------------------------------------
*/
Route::get('/debug-session', function() {
    return response()->json([
        'session' => session()->all(),
        'user' => Auth::user(),
        'auth_check' => Auth::check(),
        'session_id' => session()->getId()
    ]);
})->name('debug.session');

Route::get('/clear-session', function() {
    session()->flush();
    return "Session cleared";
})->name('session.clear');

Route::get('/setup-schools', function() {
    $schools = [
        ['name' => 'Faculté des Langues des Lettres et des Arts', 'code' => 'FLLA'],
        ['name' => 'Faculté des Sciences', 'code' => 'FS'],
        ['name' => 'Faculté des Sciences de la Santé', 'code' => 'FSS'],
        ['name' => 'Faculté des Sciences Economiques et de Gestion', 'code' => 'FSEG'],
        ['name' => 'Faculté des Sciences Juridiques, Economiques et Sociales', 'code' => 'FSJES'],
    ];

    foreach ($schools as $school) {
        School::firstOrCreate(['code' => $school['code']], $school);
    }

    return "Schools created/verified!";
})->name('schools.setup');

/*
|--------------------------------------------------------------------------
| PDF Routes
|--------------------------------------------------------------------------
*/
Route::post('/generate-pdf/inscription', [PDFController::class, 'generateInscriptionPDF'])->name('generate.inscription.pdf');
Route::post('/generate-pdf/compte-apogee', [PDFController::class, 'generateComptePDF'])->name('generate.compte.pdf');
Route::post('/generate-pdf/resultat-etudiant', [PDFController::class, 'generateResultatPDF'])->name('generate.resultat.pdf');
Route::post('/generate-pdf/resultat-module', [PDFController::class, 'generateResultatModulePDF'])->name('generate.resultat-module.pdf');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users Management - Updated to include create route
    Route::resource('users', UserController::class);

    // Activities Log
    Route::get('activities', [ActivityController::class, 'index'])->name('activities');

    // PDF Requests
    Route::get('pdf-requests', [PDFRequestController::class, 'index'])->name('pdf-requests.index');
    Route::get('pdf-requests/{id}', [PDFRequestController::class, 'show'])->name('pdf-requests.show');
});
