@extends('layouts.app') 
@section('content') 
    <div class="py-3"></div>
    @if( auth()->check())
        <div class="container">
            @if (count($incidents) > 0)
                <div class="row justify-content-center">
                    <div class="col-md-auto">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <strong>Listado de Incidencias</strong>   
                                <a href="{{ route('incidents.create') }}" class="btn btn-primary float-right">Nueva Incidencia</a>
                            </div>   
                            <div class="card-body">
                                <table class="table table-striped order-table text-center align-middle">
                                    <input class="form-control col-md-3 light-table-filter" data-table="order-table" type="text" placeholder="Ingrese texto.."></br>
                                    <thead>
                                        <th>#</th>
                                        <th colspan="2">Usuario</th>
                                        <th>Fecha</th>
                                        <th>Tipo</th>
                                        <th>Problema</th>
                                        <th>Estado</th>
                                        <th>Respuesta</th>
                                        <th>Información</th>
                                        @if( auth()->check() && auth()->user()->hasAnyRole(['Administrador', 'Supervisor']))
                                            <th colspan="2">Anotaciones</th>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @foreach ($incidents as $incident) 
                                            <tr>
                                                <td>{{ $incident->id }}</td>
                                                <td><img src="{{ asset('storage/avatars/'.$incident->user->urlavatar) }}" width="32" height="32" class="rounded-circle"></td>
                                                <td>{{ $incident->user->name }}</td>                                
                                                <?php
                                                    $time = explode (" ", $incident->created_at);
                                                    $date = $time[0];
                                                    $part = explode ("-", $date);
                                                    $ndate = $part[2]."/".$part[1]."/".$part[0];
                                                ?>  
                                                <td>{{ $ndate }}</td>
                                                <td>{{ $incident->type }}</td>
                                                <td>{{ substr($incident->description, 0, 30)}}...</td>
                                                <td>{{ $incident->state }}</td>
                                                <td>{{ substr($incident->answer, 0, 30)}}...</td>
                                                @if ($incident->state=="EN ESPERA")
                                                    @if( auth()->check() && auth()->user()->hasAnyRole(['Administrador', 'Tecnico', 'Supervisor']) )
                                                        <td>
                                                            <a href="{{ route('incidents.edit', $incident->id) }}" class="btn btn-success"><img src="{{ asset('images/svg/editar.svg')}}"/></a>
                                                        </td>
                                                    @endif
                                                @else
                                                    <td>
                                                        <a href="{{ route('incidents.show', $incident->id) }}" class="btn btn-info"><img src="{{ asset('images/svg/mostrar.svg')}}"/></a>
                                                    </td>
                                                @endif
                                                        
                                                @if( auth()->check() && auth()->user()->hasAnyRole(['Administrador', 'Supervisor']))
                                                    <td><form action="{{ route('incidents.destroy', $incident->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit" onclick="return confirm('Esta seguro de que quiere eliminar la incidencia: {{$incident->name}}')"><img src="{{ asset('images/svg/eliminar.svg')}}"/></button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('ERROR') }}</div>
                        <div class="card-body">
                            {{ __('¡Vaya! No ha sido posible encontrar esta página.!') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection