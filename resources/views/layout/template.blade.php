<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="http://cdn.ckeditor.com/4.5.4/standard/ckeditor.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poltawski+Nowy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                </li>
            </ul>

            
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
                                <a class="dropdown-item" href="{{ url('/admin/entradas') }}">Administrar Entradas</a>
                                <a class="dropdown-item" href="{{ url('/admin/users') }}">Administrar Usuarios</a>
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
        </div>
    </nav>

    @yield('contenido')

    <footer class="page-footer font-small blue mt-4">

        <div id="footer-social">
            <a href="https://github.com/csanbardev">
                <img src="{{asset('images/github.svg')}}" alt="" class="social-icon">
            </a>
            <a href="https://www.linkedin.com/in/cristian-sanchez-barba/">
                <img src="{{asset('images/linkedin.svg')}}" alt="" class="social-icon">
            </a>
            <a href="https://twitter.com/CristianSBDev">
                <img src="{{asset('images/twitter.svg')}}" alt="" class="social-icon">
            </a>
        </div>

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">
            Developed by <a href="https://csanbardev.netlify.app"> Cristian Sánchez</a>

            <img id="footer-icon" src="{{ asset('images/up.svg') }}" alt="">

        </div>
        <!-- Copyright -->

    </footer>
    <script type="text/javascript">
        const btUp = document.querySelector('#footer-icon')

        btUp.addEventListener('click', () => {
            window.scrollTo(0, 0)
        })
    </script>



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
