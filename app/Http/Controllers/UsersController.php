<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UsersController extends Controller
{
   
    public function __construct()
    {
        //El middleware permite que solo los usuarios que ha iniciado sesión
        //puedan usar este controlador, es decir, hacer las operaciones del CRUD usuarios o subir una imagen a su propio perfil
        $this->middleware('auth');
    }

    /*-------------------VISTA PRINCIPAL (LISTADO DE USUARIOS)--------------------*/
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);

        //1. Llamamos al modelo para pedir los registros de todas los usuarios con sus roles
        $users = User::with('roles')->get();

        //2. Devolvemos la vista al usuario pasándole como parámetro los datos anteriores
        return view('users.index', ['users' => $users]);
    }

    /*-------------------VISTA EDITAR--------------------*/
    public function edit($id, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
        
        //Localizamos todos los roles
        $roles = Role::all();
        //Localizamos el usuario por su id pasado como parámetro
        $user = User::where('id', $id)->with('roles')->first();

        //Mostramos la vista editar.blade.php
        return view('users.edit', compact('user', 'roles'));   
    }

    /*-------------------ACTUALIZAR DATOS--------------------*/
    public function update($id, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'birth' => ['required', 'string'],
            'telephone' => ['required', 'string', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $partes = explode('/', $request->get('birth'));

        $user = User::find($id);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->telephone =  $request->get('telephone');
        $user->address =  $request->get('address');
        $user->birth =  $partes[2]."-".$partes[1]."-".$partes[0];
        $user->roles()->sync($request->roles);
        $user->save();

        return redirect('/users')->with('success', 'Usuario actualizado!');
    }

    /*-------------------ELIMINAR USUARIO--------------------*/
    public function destroy($id, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $user = User::find($id);
        $user->delete();
        //Al final mostramos todas las tareas
        return redirect('/users')->with('success', 'Usuario eliminado!');
    }

    /*-------------------VISTA PERFIL--------------------*/
    public function profile()
    {
        $user = Auth::user();
        return view('users.perfil', ['user' => $user]);
    }

    /*-------------------SUBIR IMAGEN DE PERFIL--------------------*/
    public function update_avatar(Request $request)
    {
        $request->validate([
            'urlavatar' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        //Comprobamos si se subio algun archivo
        if($request->hasFile('urlavatar')) 
        {
            $user = Auth::user();
            $username = $user->name;
            //Asignamos el nuevo nombre de la imagen, asignando un nombre aleatorio
            $filename = $username.'_'.time().'.'.request()->urlavatar->getClientOriginalExtension();

            //Movemos la imagen al directorio imagenes de la carpeta public
            request()->urlavatar->move(public_path('/storage/avatars'), $filename);

            // - modificamos el campo imagen
            $user->urlavatar = $filename;
            $user->save();
        }
        return back()
            ->with('success','La imagen se ha actualizado correctamente.');
    }
}
