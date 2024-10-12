<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\login_Controller;
use App\Http\Controllers\signup_Controller;
use App\Http\Controllers\dashboard_Controller;
use App\Http\Controllers\Home_Controller;
use App\Http\Controllers\Movie_Controller;
use App\Http\Controllers\MovieManage_Controller;
use App\Http\Controllers\Profile_controller;

Route::get('/', [Home_Controller::class, 'homeView']);

Route::get('/allMovies', [Home_Controller::class, 'allMovieView']);

Route::get('/login', [login_Controller::class, 'loginView']);
Route::post('/login', [login_Controller::class, 'login']);

Route::get('/logout', [login_Controller::class, 'logout']);

Route::get('/signup', [signup_Controller::class, 'signupView']);
Route::post('/signup', [signup_Controller::class, 'signup']);

Route::get('/dashboard', [dashboard_Controller::class, 'dashboardView']);
Route::post('/genreChoice', [dashboard_Controller::class, 'genreChoice']);

Route::post('/search', [dashboard_Controller::class, 'searchView']);

Route::get('/movie/{id}', [Movie_Controller::class, 'movieView']);

Route::post('/addWatched', [MovieManage_Controller::class, 'addWatched']);
Route::post('/removeWatched', [MovieManage_Controller::class, 'removeWatched']);
Route::post('/addWishlist', [MovieManage_Controller::class, 'addFavourite']);
Route::post('/removeWishlist', [MovieManage_Controller::class, 'removeFavourite']);

Route::get('/favourites', [Home_Controller::class, 'favouritesView']);
Route::get('/watched', [Home_Controller::class, 'watchedView']);

Route::get('/profile', [Profile_controller::class, 'profileView']);
Route::get('/profile/{id}', [Profile_controller::class, 'anyProfile']);

Route::get('/tag/{id}', [Home_Controller::class, 'tagView']);