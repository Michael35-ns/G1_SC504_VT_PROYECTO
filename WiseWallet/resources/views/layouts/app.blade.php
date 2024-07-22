<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('styles')
    <title>WiseWallet - @yield('titulo')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dTZpGPg9lb+4m6X35iYJPL3wWyWZ8HRl3rJgtT5V3Id+ZjI5/7MXaGQCUFZ0O2GjVwBdltFl+slylbE7RYyzlA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="hold-transition sidebar-mini bg-gray-100 h-screen flex flex-col">
    <nav class="h-auto text-white p-2 bg-gray-900 flex gap-2 justify-between items-center">
        <div class="w-max bg group flex items-center space-x-4 text-white bg-gray-900">
            <img src="https://cdn-icons-png.flaticon.com/512/3058/3058953.png" class="w-12" alt="Logo">
            <span class="-mr-1 font-medium">WiseWallet</span>
        </div>
        <div>
            <a href="#" class="usuario_img">
                <img src="https://cdn-icons-png.flaticon.com/512/1057/1057231.png" class="w-11" alt="Usuario">
            </a>
        </div>
    </nav>

    <div class="flex flex-1 overflow-y-auto">
        <aside class="bg-gray-900 custom-aside h-full z-50">
            <div class="sidebar w-[4.15rem] overflow-hidden border-r border-gray-700 hover:w-60 hover:bg-gray-900 hover:shadow-lg transition-all duration-300 h-full">
                <div class="flex h-full flex-col justify-between pt-2 pb-6">
                    <div>
                        <ul class="mt-6 space-y-2 tracking-wide">
                            <li class="min-w-max">
                                <a href="/" aria-label="home" class="bg group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                    <img src="https://cdn-icons-png.flaticon.com/512/11668/11668367.png" class="w-9" alt="home">
                                    <span class="-mr-1 font-medium">Página principal</span>
                                </a>
                            </li>
                            <li class="min-w-max">
                                <a href="{{ route('crearIngreso') }}" class="bg group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                    <img src="https://cdn-icons-png.flaticon.com/256/1455/1455976.png" class="w-9" alt="Transacciones">
                                    <span class="group-hover:text-gray-300">Transacciones</span>
                                </a>
                            </li>
                            <li class="min-w-max">
                                <a href="#" class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2990/2990468.png" class="w-9" alt="Reseñas">
                                    <span class="group-hover:text-gray-300">Reseñas</span>
                                </a>
                            </li>
                            <li class="min-w-max">
                                <a href="#" class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                    <img src="https://cdn-icons-png.flaticon.com/512/5917/5917200.png" class="w-9" alt="ObjetivosEconomicos">
                                    <span class="group-hover:text-gray-300">Objetivos Económicos</span>
                                </a>
                            </li>
                            <li class="min-w-max">
                                <a href="#" class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                    <img src="https://cdn-icons-png.flaticon.com/512/4703/4703578.png" class="w-9" alt="Presupuestos">
                                    <span class="group-hover:text-gray-300">Presupuestos</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <main class="w-full p-5 min-h-10 overflow-y-auto">
            <div class="flex flex-col p-4 md:gap-8 gap-4 h-full">
                <h1 class="font-black text-gray-900 text-center text-5xl">
                    @yield('titulo')
                </h1>
                <div class="w-full flex flex-col gap-6 justify-center">
                    @yield('contenido')
                </div>
            </div>
        </main>
    </div>



    @stack('js')


</body>

</html>
