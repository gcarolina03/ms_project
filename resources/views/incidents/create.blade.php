@extends('layouts.app') 

@section('content')
  @if( auth()->check())
    <div class="row">
      <div class="col-sm-8 offset-sm-2">
        <h1 class="display-7">Nueva incidencia</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div><br/>
        @endif
        <form method="post" action="{{ route('incidents.store') }}">
          @csrf
          <input hidden name='user_id' id='user_id' value="{{ auth()->user()->id}}"/>
          <div class="form-group">
            <label for="type">Tipo de incidencia:</label>
            <select class="custom-select mr-sm-2" name="type" id="type">
              <option value="" selected>Seleccione</option>
              <option value="Sistema">Sistema</option>
              <option value="Mantenimiento">Mantenimiento</option>
              <option value="Otros">Otros</option>
            </select>
          </div><br/>
          <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
          </div><br/>       
          <button type="submit" class="btn btn btn-success">Insertar</button>
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

