<?php
use App\Http\Controllers\ProfileController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\IncidentsController;
use App\Http\Controllers\HomeController;


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
Route::get('/quien', function () {
    return view('quienes');
});
Route::get('send', [ContactoController::class, 'send']); 
Route::get('/contacto', [ContactoController::class, 'index']); 
# mostrar un perfil con los datos del usuario loggeado
Route::get('/perfil', [UsersController::class, 'profile']); 


# resource (CRUD -> index, edit, update, destroy)
Route::resource('users', UsersController::class);
# resource (CRUD -> index, store, destroy)
Route::resource('home', HomeController::class);
# resource (CRUD -> index, create, show, edit, update, destroy)
Route::resource('incidents', IncidentsController::class);


# actualizar el avatar del usuario loggeado
Route::post('/perfil', [UsersController::class, 'update_avatar'])->name('perfil.update_avatar'); 


# helper class, generate all the routes required for user authentication
Auth::routes();