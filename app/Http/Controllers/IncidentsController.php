<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Incident;



class IncidentsController extends Controller
{
    
    public function __construct()
    {
        //El middleware permite que solo los usuarios que ha iniciado sesión
        //puedan usar este controlador, es decir, hacer las operaciones del CRUD incidencias
        $this->middleware('auth');
    }

    /*-------------------VISTA PRINCIPAL--------------------*/
    public function index()
    {
        //1. Llamamos al modelo para pedir los registros de todas las incidencias con su usuario
        $incidents = Incident::with('user')->orderBy('created_at', 'desc')->get();

        //2. Devolvemos la vista al usuario pasándole como parámetro los datos anteriores
        return view('incidents.index', compact('incidents'));
    }

    /*-------------------VISTA NUEVA INCIDENCIA--------------------*/
    public function create()
    {   
        return view('incidents.create',);
    }

    /*-------------------GUARDAR NUEVA INCIDENCIA--------------------*/
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'description'=>'required',
            'type'=>'required',
        ]);

        $incidents = new Incident([
            'user_id' =>$request->get('user_id'),
            'description' => $request->get('description'),
            'type' => $request->get('type'),
            'state' => 'EN ESPERA',
        ]);
        $incidents->save();
        return redirect('/incidents')->with('success', 'Incidencia guardada!');
    }

    /*-------------------VISTA DE UNA INCIDENCIA FINALIZADA--------------------*/
    public function show($id)
    {
        //Localizamos la incidencia por su id pasado como parámetro
        $incident = Incident::find($id); 
       
        return view('incidents.show', compact('incident')); 
    }
    /*-------------------VISTA EDITAR INCIDENCIA--------------------*/

    public function edit($id, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Tecnico', 'Supervisor']);

        //Localizamos la incidencia por su id pasado como parámetro
        $incident = Incident::find($id); 
        //Mostramos la vista resources/views/incidents/edit.blade.php
        //pasando a la vista la variable $incident con los datos de la incidencia
        return view('incidents.edit', compact('incident')); 
    }
    /*-------------------ACTUALIZAR INCIDENCIA--------------------*/

    public function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Administrador', 'Tecnico', 'Supervisor']);

        $request->validate([
            'answer'=>'required',
            'state'=>'required',
        ]);

        $incident = Incident::find($id);
        $incident->answer =  $request->get('answer');
        $incident->state = $request->get('state');
        $incident->save();

        return redirect('/incidents')->with('success', 'Incidencia actualizada!');
    }
    /*-------------------ELIMINAR INCIDENCIA--------------------*/

    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Administrador', 'Supervisor']);

        $incident = Incident::find($id);
        $incident->delete();

        //Al final mostramos todas las tareas
        return redirect('/incidents')->with('success', 'Incidencia eliminada!');
    }
}
