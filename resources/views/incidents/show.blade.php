@extends('layouts.app') 
@section('content')
    @if( auth()->check())
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <h1 class="display-7">Mostrar incidencia</h1>
                <form>
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
                        <textarea class="form-control" id="description" readonly>{{ $incident->description }}</textarea>
                    </div><br/>
                    <div class="form-group">
                        <label for="answer">Respuesta:</label>
                        <textarea class="form-control" id="answer" readonly name="answer">{{ $incident->answer }}</textarea>
                    </div><br/>
                    <div class="form-group">
                        <label for="state">Estado:</label>
                        <select class="custom-select mr-sm-2" disabled name="state" id="state">
                            <option value="{{ $incident->state }}" selected>{{ $incident->state }}</option>
                        </select>
                    </div><br/>
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