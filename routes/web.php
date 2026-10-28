<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Frond-end.home');
})->name('home-index');


Route::get('/contact-us', function () {
    return view('Frond-end.contact');
})->name('contact-page');
Route::get('/about-us', function () {
    return view('Frond-end.about-us');
})->name('about-us-page');
