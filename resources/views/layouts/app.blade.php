<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @yield('styles')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand font-weight-bold text-uppercase" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        @guest
                        @else
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{ route('admin.index') }}"
                                    class="nav-link ml-2 menu-item @yield('menu-active1')">Estadisticas</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sales.index') }}"
                                    class="nav-link ml-2 menu-item @yield('menu-active2')">Ventas</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('purchases.index') }}"
                                    class="nav-link ml-2 menu-item @yield('menu-active3')">Compras</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}"
                                    class="nav-link ml-2 menu-item @yield('menu-active4')">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('contacts.index') }}"
                                    class="nav-link ml-2 menu-item @yield('menu-active5')">Contactos</a>
                            </li>
                            </ul>
                        @endguest
                    

                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                                <li class="nav-item">
                                <a class="nav-link text-white"
                                    href="{{ route('shops.edit', ['shop' => auth()->user()->shop->id]) }}">
                                    <img width="22" height="22" class="rounded-circle"
                                        src="{{ asset('/storage/' . auth()->user()->shop->image) }}"
                                        alt="{{ auth()->user()->shop->name }}">
                                    {{ auth()->user()->shop->name }}
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>

        <main class="py-4 p-4">
            @if (session('success'))
                <div class="alert alert-info" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger" role="alert">
                    {{ session('danger') }}
                </div>
            @endif

            <div class="card card-body shodow-sm">
                @yield('content')
            </div>
        </main>
    </div>

    @yield('scripts')

</body>

</html>
