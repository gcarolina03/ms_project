

@extends('layouts.app') 
@section('content')
    <div class="py-1"></div>
    <section class="text-center">
        <div class="container">
            <h1>CONTACTANOS</h1>
        </div>
    </section>
    <div class="container py-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <img width="25" src="{{ asset('images/svg/envelope.svg')}}"/> Contactanos
                    </div>
                    <div class="card-body">
                        <form method="GET" action='send'>
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Escribe tu nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electronico</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Escribe tu correo" required>
                                <small id="emailHelp" class="form-text text-muted">No compartiremos tu correo con nadie más.</small>
                            </div>
                            <div class="form-group">
                                <label for="message">Mensaje</label>
                                <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                            </div>
                            <div class="mx-auto"></br>
                                <button type="submit" class="btn btn-primary text-right">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card bg-light mb-3">
                    <div class="card-header bg-success text-white text-uppercase">
                        <img width="15" src="{{ asset('images/svg/geo-alt.svg')}}"/> DirecciÓn
                    </div>
                    <div class="card-body">
                        <p>C. las Borreras, 1</p>
                        <p>35019 LAS PALMAS</p>
                        <p>ESPAÑA</p>
                        <p>Email : email@example.com</p>
                        <p>Tel. +34 928 41 96 15</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center">
        <div class="container p-1 pb-0">
            <section class="mb-4">
                <!-- Facebook -->
                <a href="#!"><img class="btn btn-social mx-2" src="{{ asset('images/svg/facebook.svg')}}"/></a>
                <!-- Twitter -->
                <a href="#!"><img class="btn btn-social mx-2" src="{{ asset('images/svg/twitter.svg')}}"/></a>
                <!-- Google -->
                <a href="#!"><img class="btn btn-social mx-2" src="{{ asset('images/svg/google.svg')}}"/></a>
                <!-- Instagram -->
                <a href="#!"><img class="btn btn-social mx-2" src="{{ asset('images/svg/instagram.svg')}}"/></a>
                <!-- Linkedin -->
                <a href="#!"><img class="btn btn-social mx-2" src="{{ asset('images/svg/linkedin.svg')}}"/></a>
                <!-- Github -->
                <a href="#!"><img class="btn btn-social mx-2" src="{{ asset('images/svg/github.svg')}}"/></a>
            </section>
        </div>
    </footer>
@endsection