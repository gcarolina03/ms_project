<?php
use App\Http\Controllers\ProfileController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('inicio');
});

Auth::routes();

Route::resource('home', 'App\Http\Controllers\HomeController');


Route::get('/quien', function () {
    return view('quienes');
});

Route::resource('contacto', 'App\Http\Controllers\ContactoController');
Route::get('send', 'App\Http\Controllers\ContactoController@send');

Route::resource('users', 'App\Http\Controllers\UsersController');
Route::get('perfil', 'App\Http\Controllers\UsersController@profile');
Route::post('perfil', 'App\Http\Controllers\UsersController@update_avatar');

Route::resource('incidents', 'App\Http\Controllers\IncidentsController');


