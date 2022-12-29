<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-commerce') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a href="{{ url('/') }}" class="navbar-brand">E-Commerce</a>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::user()->name}}</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a href="{{ route('user.home') }}" class="dropdown-item"> Profile</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="dropdown-item">
                                        Logout
                                    </a>
                                    
                                </li>
                            </ul>
                        </li>
                    </ul>
                            
                    @else
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <li>
                        <a href="{{ route('login') }}" class="nav-link">
                            Log in
                        </a>
                    </li>

                        @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}" class="nav-link">
                                Register
                            </a>
                        </li>
                    </ul>
                        @endif
                    @endauth
                </div>
            @endif
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="#!" class="nav-link">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a href="#!" class="dropdown-item"> All Products</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="#!" class="dropdown-item"> Popular items</a>
                        </li>
                        <li>
                            <a href="#!" class="dropdown-item"> New Arrivals</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <form action="" class="d-flex">
                <button class="btn btn-outline-dark" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-cart-fill" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1
                        .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61
                        2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2
                        0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <span class="bi-cart-fill me-1">Cart</span>
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </form>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
