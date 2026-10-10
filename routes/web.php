<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

// Pendaftaran 7 route RESTful otomatis dalam 1 baris kode
Route::resource('posts', PostController::class);
