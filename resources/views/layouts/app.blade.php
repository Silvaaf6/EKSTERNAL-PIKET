<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div id="app">
        <nav class="bg-white shadow-md sticky top-0">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <a class="text-lg font-semibold text-gray-800" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div class="hidden md:flex md:items-center md:space-x-4" id="navbarSupportedContent">
                    <ul class="flex space-x-4">
                        <!-- Left Side Of Navbar -->
                    </ul>

                    <ul class="flex space-x-4">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="text-gray-800 hover:text-gray-600"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="text-gray-800 hover:text-gray-600"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="relative group">
                                <a class="text-gray-800 hover:text-gray-600 cursor-pointer">
                                    {{ Auth::user()->name }}
                                </a>

                                <!-- Dropdown Menu -->
                                <div
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <a class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-8">
            @yield('content')
        </main>
    </div>

</body>

</html>
