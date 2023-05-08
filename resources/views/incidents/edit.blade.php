@extends('layouts.app') 
@section('content')
    @if( auth()->check() && auth()->user()->hasAnyRole(['Administrador', 'Tecnico', 'Supervisor']) )
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <h1 class="display-7">Editar una incidencia</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/> 
                @endif
                <form method="post" action="{{ route('incidents.update', $incident->id) }}">
                    @method('PATCH') 
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id" readonly value="{{ $incident->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="user" readonly value="{{ $incident->user }}" />
                    </div>
                    <div class="form-group">
                        <label for="type">Tipo de incidencia:</label>
                        <input type="text" class="form-control" name="user" readonly value="{{ $incident->type }}" />
                    </div><br/>
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea class="form-control" id="description" readonly name="description">{{ $incident->description }}</textarea>
                    </div><br/>
                    <div class="form-group">
                        <label for="answer">Respuesta:</label>
                        <textarea class="form-control" id="answer" name="answer">{{ $incident->answer }}</textarea>
                    </div><br/>
                    <div class="form-group">
                        <label for="state">Estado:</label>
                        <select class="custom-select mr-sm-2" name="state" id="state">
                            @if ($incident->state=="EN ESPERA")
                                <option value="EN ESPERA" selected>EN ESPERA</option>
                                <option value="FINALIZADA">FINALIZADA</option>
                            @else
                                <option value="EN ESPERA">EN ESPERA</option>
                                <option value="FINALIZADA" selected>FINALIZADA</option>
                            @endif
                        </select>
                    </div><br/>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
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