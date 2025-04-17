<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameObject;
use App\Models\Guess;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    // Affiche un objet mystère à deviner
    public function show()
    {
        $object = GameObject::inRandomOrder()->first();

        return view('game.play', compact('object'));
    }

    // Traite la devinette de l'utilisateur
    public function submit(Request $request)
    {
        $request->validate([
            'object_id' => 'required|exists:objects,id',
            'guessed_price' => 'required|numeric|min:0',
            'time_taken' => 'nullable|integer|min:0',
        ]);

        $object = GameObject::findOrFail($request->object_id);
        $actual = $object->real_price;
        $guess = $request->guessed_price;
        $diff = abs($actual - $guess);
        $tolerance = $actual * 0.2;

        // Détermination du score
        $score = 0;
        $feedback = 'Pas tout à fait…';

        if ($diff <= ($actual * 0.05)) {
            $score = 3;
            $feedback = 'Incroyable ! Tu es ultra proche !';
        } elseif ($diff <= ($actual * 0.10)) {
            $score = 2;
            $feedback = 'Super ! Tu t’en sors bien.';
        } elseif ($diff <= $tolerance) {
            $score = 1;
            $feedback = 'Pas mal, tu chauffes.';
        }

        // Sauvegarde de la tentative
        // Création de la devinette
        Guess::create([
            'user_id' => Auth::id(),
            'object_id' => $object->id,
            'guessed_price' => $guess,
            'score' => $score,
            'time_taken' => $request->time_taken ?? null,
            'attempt_number' => 1,
            'feedback' => $feedback,
        ]);

        $user = Auth::user();
        $user->total_score += $score;
        $user->save(); // Sauvegarde manuelle du score total


        return view('game.result', [
            'object' => $object,
            'guessed_price' => $guess,
            'actual_price' => $actual,
            'score' => $score,
            'feedback' => $feedback,
        ]);
    }
}
