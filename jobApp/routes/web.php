<?php
use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\edit_courseController;
use App\Http\Controllers\Generate_codesController;
////////////////////////////////
/*
Route::domain('{account}.myapp.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
    });
});*/

Route::get('/', 'HomeController@index');
Route::get('/register/view', 'HomeController@register')->name('register');
Route::get('/login/view', 'HomeController@login')->name('login'); // update user profile info


/////////////////////////
Route::get('/export', 'HomeController@export')->name("export");
Route::post('/import', 'HomeController@import')->name("import");
