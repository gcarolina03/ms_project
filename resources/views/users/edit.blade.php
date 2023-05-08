@extends('layouts.app') 
@section('content')
    <div class="py-2"></div>
    @if( auth()->check() && auth()->user()->hasAnyRole(['Administrador']) )
        <div class="container">
            <div class="row">
                <div class="col-sm-10 offset-sm-1">
                    <h4>Modificar un usuario</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('users.update', $user->id) }}">
                        @method('PATCH') 
                        @csrf
                        <div class="row mt-2 align-items-center">           
                            <div class="col-md-1 text-center mb-2">
                                <div class="avatar avatar-xl">
                                    <img src="{{ asset('storage/avatars/'.$user->urlavatar) }}" alt="..." class="avatar-img rounded-circle" />
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group col-md-2">
                                    <label for="id">id:</label>
                                    <input type="text" class="form-control" name="id" readonly="readonly" value="{{ $user->id }}" />
                                </div>
                            </div>
                        </div>
                        <hr class="my-1" />
                        <div class="form-group">
                            <label for="roles">Roles:</label>
                            <table class="table table-bordered">
                                <tr>
                                    @foreach ($roles as $rol)
                                        @php($condicion = $user->roles->where('id', $rol->id)->isNotEmpty())
                                        <th class="text-center align-middle">
                                            <input type="checkbox" name="roles[]" value="{{ $rol->id }}" @if ($condicion) checked @endif>
                                            <label>{{ $rol->name }}</label>
                                        </th>
                                        <td class="align-middle"><label>{{ $rol->description }}</label> </td>
                                    @endforeach
                                </tr>
                            </table>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-7">
                                <label for="name">Nombre Completo:</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" />
                            </div>
                            <div class="form-group col-md-5">
                                <?php
                                $partes = explode ("-", $user->birth);
                                $nbirth = $partes[2]."/".$partes[1]."/".$partes[0];
                                ?>
                                <label for="birth">Fecha de Nacimiento</label>
                                <input type="text" class="form-control" id="fecha" name="birth" value="{{ $nbirth }}" />
                            </div>
                        </div>
                        <div class="form-group py-3">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control" name="address" value="{{ $user->address }}" />
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="telephone">Telefono</label>
                                <input type="text" class="form-control" name="telephone" value="{{ $user->telephone }}" />
                            </div> 
                        </div><br/> 
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
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