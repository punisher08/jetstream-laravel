<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
// Route::resource('/tasks', TaskController::class);
// Route::resource('/tasks', TaskController::class);
Route::get('/tasks','TaskController@index');
Route::post('/store','TaskController@store');
Route::get('/delete/{id}','TaskController@destroy');
Route::get('/edit/{id}','TaskController@edit');
Route::post('/update/{id}','TaskController@update');