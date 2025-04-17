<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $guesses = $user->guesses()->with('object')->latest()->get(); // Récupérer les devinettes avec l'objet

        return view('score.index', compact('user', 'guesses'));
    }
}
