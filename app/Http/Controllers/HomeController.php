<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   
    public function __construct()
    {
        //El middleware permite que solo los usuarios que ha iniciado sesión
        //puedan usar este controlador, es decir, hacer las operaciones del feed
        $this->middleware('auth');
    }

    /*-------------------VISTA PRINCIPAL--------------------*/
    public function index()
    {   
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();

        //2. Devolvemos la vista al usuario pasándole como parámetro los datos anteriores
        return view('home', compact('posts'));
    }

    /*-------------------PUBLICAR EN EL FEED--------------------*/
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'content'=>'required',
        ]);

        $posts = new Post([
            'user_id' =>$request->get('user_id'),
            'content' => $request->get('content'),
        ]);
        $posts->save();

        return redirect('/home')->with('success', 'Publicado!');
    }

    /*-------------------ELIMINAR POST--------------------*/
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        //Al final mostramos todas las tareas
        return redirect('/home')->with('success', 'Publicación eliminada!');
    }
}
