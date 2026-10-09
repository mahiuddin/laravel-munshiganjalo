<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\SearchController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');

Route::get('/news/{news:slug}', [NewsController::class, 'show'])
    ->name('news.show');

Route::get('/category/{category:slug}', [CategoryController::class, 'show'])
    ->name('category.show');

Route::get('/district/{district:slug}', [DistrictController::class, 'show'])
    ->name('district.show');

Route::get('/upazila/{upazila:slug}', [UpazilaController::class, 'show'])
    ->name('upazila.show');

Route::get('/search', [SearchController::class, 'index'])
    ->name('search');

Route::view('/about', 'pages.about')
    ->name('about');

Route::view('/contact', 'pages.contact')
    ->name('contact');
