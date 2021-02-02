<?php
// use App\Http\livewire\Frontpage;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
// Route::resource('/tasks', TaskController::class);
// Route::resource('/tasks', TaskController::class);




Route::group(['middleware' => [
    'auth:sanctum',
    'verified'
]], function(){
        Route::get('/dashboard', function(){
            return view('dashboard');
        })->name('dashboard');

        Route::get('/pages', function(){
            return view('admin.page');
        })->name('pages');

        Route::get('/tasks','TaskController@index');
        Route::get('/create','TaskController@createTask');
        Route::post('/store','TaskController@store');
        Route::get('/delete/{id}','TaskController@destroy');
        Route::get('/edit/{id}','TaskController@edit');
        Route::post('/update/{id}','TaskController@update');
       
});

Route::get('/{urlslug}', [\App\Http\Livewire\Frontpage::class, '__invoke'])->name('frontpage');
Route::get('/',[\App\Http\Livewire\Frontpage::class, '__invoke']);
