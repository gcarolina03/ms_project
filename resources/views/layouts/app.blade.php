<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>Proyecto-ms</title>
    <!-- Agregamos la librería JQuery UI y el tema CALENDARIO-->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src={{ asset('js/bootstrap.bundle.min.js')}}></script>
    <script src={{ asset('js/ext.js')}}></script>
    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css')}}">
  </head>
  <body>
    <header class="p-3 bg-dark">
      <div class="container">
        <div class="d-flex">
          <a href="/" class="navbar-brand text-light">Proyecto</a>
          
          @guest
            <ul class="nav me-lg-auto">
              <li><a href="/" class="nav-link px-2 link-secondary">Bienvenida</a></li>
              <li><a href="/quien" class="nav-link px-2 link-light">Quienes Somos</a></li>
              <li><a href="/contacto" class="nav-link px-2 link-light">Contacto</a></li>
            </ul>

            <div class="text-end">
              <button type="button" class="btn btn-success me-2"><a class="nav-link py-0 px-1 link-dark" href="{{ route('login') }}">Iniciar Sesion</a></button>
              <button type="button" class="btn btn-warning"><a class="nav-link py-0 px-1 link-dark" href="{{ route('register') }}">Registrarse</a></button>
            </div>
        
          @else
          
            @if( auth()->check())
              <ul class="nav me-lg-auto">
                <li><a href="/home" class="nav-link px-2 link-secondary">Inicio</a></li>
                <li><a href="/incidents" class="nav-link px-2 link-light">Incidencias</a></li>
                @if (auth()->user()->hasAnyRole('Administrador'))
                  <li><a href="/users" class="nav-link px-2 link-light">Usuarios</a></li>
                @endif
              </ul>

              <div class="dropdown text-end">
                <a href="#" class="link-light text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src=" {{ asset('storage/avatars/'.auth()->user()->urlavatar) }} " alt="mdo" width="32" height="32" class=" me-2 rounded-circle">{{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                  <li><a class="dropdown-item" href="/perfil">Perfil</a></li>
                  <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Cerrar Sesion</a></li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </ul>
              </div>
            @endif

          @endguest
        </div>
      </div>
    </header>

    <main class="py-auto">
      @yield('content')
    </main>
  </body>
</html>
