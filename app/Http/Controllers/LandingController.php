<?php

namespace App\Http\Controllers;

use App\Models\Armada;

class LandingController extends Controller
{
    public function index()
    {
        $armadas = Armada::with('fasilitas')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('landing.index', compact('armadas'));
    }
}
