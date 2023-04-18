<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('users', UserController::class);
//    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::post('delete/user/{user_id}', [UserController::class, 'delete'])->name('users.delete');


    /*
    |--------------------------------------------------------------------------
    |  Lang Routes
    |--------------------------------------------------------------------------
    */
    Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

});

require __DIR__.'/auth.php';
