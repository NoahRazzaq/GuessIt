<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/upload-test', function () {
    return '
        <form method="POST" action="/upload-test" enctype="multipart/form-data">
            '.csrf_field().'
            <input type="file" name="image" />
            <button type="submit">Uploader</button>
        </form>
    ';
});

Route::post('/upload-test', function (Request $request) {
    $path = $request->file('image')->store('test', 's3');
    $url = Storage::disk('s3')->url($path);
    return "Image uploadée ! <br><a href='$url' target='_blank'>$url</a>";
});

