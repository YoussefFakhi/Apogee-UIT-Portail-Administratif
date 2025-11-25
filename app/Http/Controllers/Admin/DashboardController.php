<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Activity;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     $usersCount = User::count();
    //     $activitiesCount = Activity::count();
    //     $recentActivities = Activity::latest()->take(5)->get();

    //     return view('admin.dashboard', compact('usersCount', 'activitiesCount', 'recentActivities'));
    // }

    public function index()
{
    $usersCount = User::count();
    $activitiesCount = Activity::count();
    $pdfRequestsCount = Activity::whereIn('type', [
        'inscription',
        'compte',
        'resultat_etudiant',
        'resultat_module'
    ])->count();

    $recentActivities = Activity::latest()->take(5)->get();

    return view('admin.dashboard', compact(
        'usersCount',
        'activitiesCount',
        'pdfRequestsCount',
        'recentActivities'
    ));
}
}
