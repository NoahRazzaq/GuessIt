<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::post('/upload-test', function (Request $request) {
    if (!$request->hasFile('image')) {
        return 'Aucun fichier reçu.';
    }

    $file = $request->file('image');

    if (!$file->isValid()) {
        return 'Le fichier n\'est pas valide.';
    }

    $path = $file->store('test', 's3');

    if (!$path) {
        return 'Échec de l\'upload.';
    }

    $url = Storage::disk('s3')->url($path);
    return "Image uploadée ! <br><a href='$url' target='_blank'>$url</a>";
});
