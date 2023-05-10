<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="justify-content: space-between;">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Inicio</a>
            </li>
            

        </ul>
        @guest
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{url('/login')}}" class="nav-link">Iniciar sesión</a></li>
                <li class="nav-item"><a href="{{url('/register')}}" class="nav-link">Registrarse</a></li>
            </ul>
        @endguest
        @auth
            <ul class="navbar-nav">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ url('/create') }}">Añadir</a>
                        <a class="dropdown-item" href="{{ url('/user') }}">Mis entradas</a>
                        @can('admin')
                            <a class="dropdown-item" href="{{ url('/admin') }}">Administrar Entradas</a>
                            <a class="dropdown-item" href="{{ url('/admin/user') }}">Administrar Usuarios</a>
                            <a class="dropdown-item" href="{{ url('/admin/logs') }}">Administrar Logs</a>
                        @endcan
                        <form action="/logout" method="post">
                          @csrf
                          <button class="dropdown-item btn " type="submit">Cerrar sesión</button>
                        </form>
                        
                    </div>
                </li>
            </ul>

        @endauth
    </nav>

    @yield('contenido')

    <footer class="page-footer font-small blue mt-4">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2022 Copyright:
            <a href="/"> Recetazas.com</a>
        </div>
        <!-- Copyright -->

    </footer>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
