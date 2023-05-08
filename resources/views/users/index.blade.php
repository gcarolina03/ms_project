@extends('layouts.app') 

@section('content') 
    <div class="py-3"></div>
    @if( auth()->check() && auth()->user()->hasAnyRole('Administrador') )
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-auto">
                    <div class="card">
                        @if (count($users) > 0)
                            <div class="card-header">
                                <strong>Listado de los Usuarios</strong>   
                            </div>   

                            <div class="card-body">
                                <table class="table table-striped text-center align-middle">
                                    <input class="form-control col-md-3 light-table-filter" data-table="order-table" type="text" placeholder="Ingrese un nombre.."/></br>
                                    <thead class="">
                                        <th>#</th>
                                        <th>Imagen</th>
                                        <th>Roles</th>
                                        <th>Nombre Completo</th>
                                        <th>Correo Electronico</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th colspan="2">Anotaciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user) 
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td><img src="{{ asset('storage/avatars/'.$user->urlavatar) }}" width="32" height="32" class="rounded-circle"></td>
                                                <td>
                                                    @foreach ( $user->roles as $rol)
                                                        {{ $rol->name }}<br/>
                                                    @endforeach
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->telephone }}</td>
                                                <td>{{ $user->address }}</td>
                                                <?php
                                                    $partes = explode ("-", $user->birth);
                                                    $nbirth = $partes[2]."/".$partes[1]."/".$partes[0];
                                                ?>  
                                                <td>{{$nbirth}}</td>  
                                                <td>
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success"><img src="{{ asset('images/svg/editar.svg')}}"/></a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit" onclick="return confirm('Esta seguro de que quiere eliminar el usuario: {{$user->name}}')"><img src="{{ asset('images/svg/eliminar.svg')}}"/></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="card-body">
                                <strong>No hay registro</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
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