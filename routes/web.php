<?php

use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/program', function () {
    return view('pages.program');
})->name('program');

use App\Models\KepentinganUmum;

Route::get('/gallery', function () {
    $kegiatan = KepentinganUmum::whereNotNull('bukti_foto')->latest('tanggal')->get();
    return view('pages.gallery', compact('kegiatan'));
})->name('gallery');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
