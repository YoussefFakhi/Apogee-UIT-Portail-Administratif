<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
{
    $activities = Activity::with('user')->latest()->paginate(10);
    return view('admin.activities.index', compact('activities'));
}
}
