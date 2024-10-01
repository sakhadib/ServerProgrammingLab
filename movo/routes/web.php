<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login_Controller;
use App\Http\Controllers\signup_Controller;
use App\Http\Controllers\dashboard_Controller;


Route::get('/login', [login_Controller::class, 'loginView']);
Route::post('/login', [login_Controller::class, 'login']);

Route::get('/logout', [login_Controller::class, 'logout']);

Route::get('/signup', [signup_Controller::class, 'signupView']);
Route::post('/signup', [signup_Controller::class, 'signup']);

Route::get('/dashboard', [dashboard_Controller::class, 'dashboardView']);
Route::post('/genreChoice', [dashboard_Controller::class, 'genreChoice']);