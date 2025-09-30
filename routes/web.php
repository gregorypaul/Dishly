<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('home');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

// Handle login POST
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

// Handle logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

Route::middleware('auth')->group(function(){
    Route::get('/recipes/recipe', [RecipeController::class, 'create'])->name('create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('store');
});

Route::post('/recipes/{recipe}/rate', [RatingController::class, 'store'])
    ->name('recipes.rate')
    ->middleware('auth');


require __DIR__.'/auth.php';
