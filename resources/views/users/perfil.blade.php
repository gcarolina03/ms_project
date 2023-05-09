@extends('layouts.app')

@section('content')
    @if( auth()->check())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                    <div class="my-3">
                        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" role="tab" aria-controls="home" aria-selected="false">Perfil</a>
                            </li>
                        </ul>                
                        <div class="row mt-2 align-items-center">
                            <div class="col-md-2 text-center mb-5">
                                <div class="avatar-xl">
                                    <img src="{{ asset('storage/avatars/'.auth()->user()->urlavatar) }}" alt="..." class="rounded-circle" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h4 class="mb-1">{{ $user->name }}</h4>
                                        @php $roles = $user->roles @endphp
                                        <small><i>Roles:
                                        @foreach($roles as $rol)
                                            {{ $rol->name }}
                                        @endforeach
                                        </i></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-1"/>
                        <form action=" {{route('perfil.update_avatar')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-7">
                                    <label for="name">Nombre</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="{{ $user->name }} " readonly/>
                                </div>
                                <div class="form-group col-md-5">
                                    <?php
                                    $fecha =  $user->birth;
                                    $partes = explode ("-", $fecha);
                                    $nbirth = $partes[2]."/".$partes[1]."/".$partes[0];
                                    ?>
                                    <label for="birth">Fecha de Nacimiento</label>
                                    <input type="text" id="birth" name="birth" class="form-control" placeholder="{{ $nbirth }} " readonly/>
                                </div>
                            </div>
                            <div class="form-group py-3">
                                <label for="address">Dirección</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="{{ $user->address }}" readonly/>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="{{ $user->email }}" readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="telephone">Telefono</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="telephone" id="telephone" placeholder="{{ $user->telephone }}" readonly/>
                                    </div>
                                </div> 
                            </div>
                            <div class="form-group col-md-5">
                                <label for="urlavatar" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>
                                <input id="urlavatar" type="file" class="form-control-file @error('urlavatar') is-invalid @enderror" name="urlavatar">
                                @error('urlavatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br/><button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
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
