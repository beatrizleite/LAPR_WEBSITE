<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ config('app.name', 'E-commerce') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">E-Commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                @if (Route::has('login'))
                    @auth

                        <ul class="navbar-nav me-auto" style="margin-left: 10px; margin-right: 10px;">
                            <li class="nav-item dropdown">
                                <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li class="nav-link">
                                        <a href="{{ route('user.home') }}" class="dropdown-item"> Profile</a>
                                    </li>
                                    <li class="nav-link">
                                        <a href="{{ route('logout') }}" class="dropdown-item">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav me-auto">
                            <li class="nav-link">
                                <a href="{{ route('login') }}" class="nav-link">
                                    Log in
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-link">
                                    <a href="{{ route('register') }}" class="nav-link">
                                        Register
                                    </a>
                                </li>
                        </ul>
                    @endif
                @endauth
            </div>
            @endif
            <ul class="navbar-nav" style="margin-left: 50px; margin-right: 50px;">
                <li class="nav-item">
                    <a href="#!" class="nav-link">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                        data-bs-toggle="dropdown" style="margin-right: 10px;">Shop</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" class="dropdown-item"> All Products</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="#" class="dropdown-item"> Popular items</a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item"> New Arrivals</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <form action="/search" class="d-flex">
                        <input class="form-control me-2" type="text" name="query" placeholder="Search">
                        <button class="btn btn-outline-light" type="submit" style="margin-right: 10px;">Search</button>
                    </form>
                </li>
                <li class="nav-item">
                    <form action="">
                        <button class="btn btn-outline-light" type="submit" style="white-space: nowrap;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cart" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1
                            .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0
                            1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5
                            0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2
                            0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7
                            1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <span>0</span>
                        </button>
                    </form>
                </li>

        </div>
        </ul>
    </nav>
    <main>
        @yield('content')
    </main>
    <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>
</body>

</html>
