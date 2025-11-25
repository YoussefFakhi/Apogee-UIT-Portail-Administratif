<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;

class PDFRequestController extends Controller
{
    public function index()
    {
        $requests = Activity::whereIn('type', ['inscription', 'compte', 'resultat_etudiant', 'resultat_module'])
            ->with('user')
            ->latest()
            ->paginate(15);

        return view('admin.pdf-requests.index', compact('requests'));
    }

    public function show($id)
    {
        $request = Activity::with('user')->findOrFail($id);
        return view('admin.pdf-requests.show', compact('request'));
    }
}
