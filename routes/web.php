<?php
use App\Http\Controllers\ProfileController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\IncidentsController;


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

# helper class, generate all the routes required for user authentication
Auth::routes();

# resource (CRUD -> index, store, destroy)
Route::resource('home', 'App\Http\Controllers\HomeController');


Route::get('/quien', function () {
    return view('quienes');
});

Route::get('/contacto', [ContactoController::class, 'index']); 
Route::get('send', [ContactoController::class, 'send']); 

# resource (CRUD -> index, edit, update, destroy)
Route::resource('users', UsersController::class);
# mostrar un perfil con los datos del usuario loggeado
Route::get('perfil', [UsersController::class, 'profile']); 
# actualizar el avatar del usuario loggeado
Route::post('perfil', [UsersController::class, 'update_avatar']); 

# resource (CRUD -> index, create, show, edit, update, destroy)
Route::resource('incidents', IncidentsController::class);


