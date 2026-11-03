<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PersonalityController;
use App\Http\Controllers\HistoricalPlaceController;
use App\Http\Controllers\DistrictInformationController;
use App\Http\Controllers\EducationInstitutionController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\MediaOutletController;
use App\Http\Controllers\DirectoryController;

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

// Personality Routes
Route::get('/personalities', [PersonalityController::class, 'index'])
    ->name('personalities.index');

Route::get('/personalities/{personality:slug}', [PersonalityController::class, 'show'])
    ->name('personalities.show');

Route::get('/personality-category/{category:slug}', [PersonalityController::class, 'category'])
    ->name('personality-category.show');

Route::get('/historical-places', [HistoricalPlaceController::class, 'index'])
    ->name('historical-places.index');

Route::get('/historical-places/{historicalPlace:slug}', [HistoricalPlaceController::class, 'show'])
    ->name('historical-places.show');

Route::get('/historical-place-category/{category:slug}', [HistoricalPlaceController::class, 'category'])
    ->name('historical-place-category.show');    

Route::get('/district-information', [DistrictInformationController::class, 'show'])
    ->name('district-information.show');

Route::get('/education-institutions', [EducationInstitutionController::class, 'index'])
    ->name('education-institutions.index');

Route::get('/education-institutions/{educationInstitution:slug}', [EducationInstitutionController::class, 'show'])
    ->name('education-institutions.show');

Route::get('/education-category/{category:slug}', [EducationInstitutionController::class, 'category'])
    ->name('education-category.show');

// Organization Routes
Route::get('/organizations', [OrganizationController::class, 'index'])
    ->name('organizations.index');

Route::get('/organizations/{organization:slug}', [OrganizationController::class, 'show'])
    ->name('organizations.show');

Route::get('/organization-category/{category:slug}', [OrganizationController::class, 'category'])
    ->name('organization-category.show');


// Media Outlet Routes
Route::get('/media-outlets', [MediaOutletController::class, 'index'])
    ->name('media-outlets.index');

Route::get('/media-outlets/{mediaOutlet:slug}', [MediaOutletController::class, 'show'])
    ->name('media-outlets.show');

Route::get('/media-outlet-category/{category:slug}', [MediaOutletController::class, 'category'])
    ->name('media-outlet-category.show');


// Public Directory Routes
Route::get('/public-directory', [DirectoryController::class, 'index'])
    ->name('directories.index');

Route::get('/public-directory/{directoryEntry:slug}', [DirectoryController::class, 'show'])
    ->name('directories.show');

Route::get('/directory-category/{category:slug}', [DirectoryController::class, 'category'])
    ->name('directory-category.show');

Route::view('/about', 'pages.about')
    ->name('about');

Route::view('/contact', 'pages.contact')
    ->name('contact');
