<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>WiseWallet -@yield('titulo')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="bg-gray-100">
    <a href="#" class="usuario_img">
        <img src="https://cdn-icons-png.flaticon.com/512/1057/1057231.png" class="w-11" alt="Usuario">
    </a>

    <aside class="bg-gray-900 custom-aside">
        <div
            class="sidebar w-[4.15rem] overflow-hidden border-r border-gray-700 hover:w-60 hover:bg-gray-900 hover:shadow-lg transition-all duration-300">
            <div class="flex h-screen flex-col justify-between pt-2 pb-6">
                <div>
                    <div class="w-max p-2.5 bg group flex items-center space-x-4 text-white">
                        <img src="https://cdn-icons-png.flaticon.com/512/3058/3058953.png" class="w-12"
                            alt="Logo">
                        <span class="-mr-1 font-medium">WiseWallet</span>
                    </div>
                    <ul class="mt-6 space-y-2 tracking-wide">
                        <li class="min-w-max">
                            <a href="#" aria-label="home"
                                class="bg group flex items-center space-x-4 rounded-full px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                <img src="https://cdn-icons-png.flaticon.com/512/11668/11668367.png" class="w-9"
                                    alt="home">
                                <span class="-mr-1 font-medium">Página principal</span>
                            </a>
                        </li>
                        <li class="min-w-max">
                            <a href="#"
                                class="bg group flex items-center space-x-4 rounded-full px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                <img src="https://cdn-icons-png.flaticon.com/256/1455/1455976.png" class="w-9"
                                    alt="Transacciones">
                                <span class="group-hover:text-gray-300">Transacciones</span>
                            </a>
                        </li>
                        <li class="min-w-max">
                            <a href="#"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                <img src="https://cdn-icons-png.flaticon.com/512/2990/2990468.png" class="w-9"
                                    alt="Reseñas">
                                <span class="group-hover:text-gray-300">Reseñas</span>
                            </a>
                        </li>
                        <li class="min-w-max">
                            <a href="#"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                <img src="https://cdn-icons-png.flaticon.com/512/5917/5917200.png" class="w-9"
                                    alt="ObjetivosEconomicos">
                                <span class="group-hover:text-gray-300">Objetivos Economicos</span>
                            </a>
                        </li>
                        <li class="min-w-max">
                            <a href="#"
                                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                <img src="https://cdn-icons-png.flaticon.com/512/4703/4703578.png" class="w-9"
                                    alt="Presupuestos">
                                <span class="group-hover:text-gray-300">Presupuestos</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <div class="content p-4">
        <h1 class="text-2xl font-bold mb-4">Roles</h1>
        <ul>
            @foreach ($roles as $rol)
            <li>
                <strong>ID:</strong> {{ $rol->ID_ROL }}<br>
                <strong>Descripción:</strong> {{ $rol->DESCRIPCION }}<br>
                <strong>Nombre del Rol:</strong> {{ $rol->NOMBRE_ROL }}<br>
                <strong>Usuario Registrado:</strong> {{ $rol->USUARIO_REG }}<br>
                <strong>Fecha de Acción:</strong> {{ $rol->FECHA_ACCION }}<br>
                <strong>Acción:</strong> {{ $rol->ACCION }}
                <hr class="my-4">
            </li>
            @endforeach
        </ul>
    </div>

</body>

</html>
