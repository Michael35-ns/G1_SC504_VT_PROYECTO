<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('styles')
    <title>WiseWallet - @yield('titulo')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="hold-transition sidebar-mini bg-gray-100 h-screen flex flex-col">
        <a href="#" class="usuario_img absolute top-4 right-4">
            <img src="https://cdn-icons-png.flaticon.com/512/1057/1057231.png" class="w-11" alt="Usuario">
        </a>

        <div class="flex flex-1 overflow-hidden">
            <aside class="bg-gray-900 custom-aside h-full">
                <div
                    class="sidebar w-[4.15rem] overflow-hidden border-r border-gray-700 hover:w-60 hover:bg-gray-900 hover:shadow-lg transition-all duration-300 h-full">
                    <div class="flex h-full flex-col justify-between pt-2 pb-6">
                        <div>
                            <div class="w-max p-2.5 bg group flex items-center space-x-4 text-white">
                                <img src="https://cdn-icons-png.flaticon.com/512/3058/3058953.png" class="w-12"
                                    alt="Logo">
                                <span class="-mr-1 font-medium">WiseWallet</span>
                            </div>
                            <ul class="mt-6 space-y-2 tracking-wide">
                                <li class="min-w-max">
                                    <a href="/" aria-label="home"
                                        class="bg group flex items-center space-x-4 rounded-full px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                        <img src="https://cdn-icons-png.flaticon.com/512/11668/11668367.png"
                                            class="w-9" alt="home">
                                        <span class="-mr-1 font-medium">Página principal</span>
                                    </a>
                                </li>
                                <li class="min-w-max">
                                    <a href="{{ route('crearIngreso') }}"
                                        class="bg group flex items-center space-x-4 rounded-full px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                        <img src="https://cdn-icons-png.flaticon.com/256/1455/1455976.png"
                                            class="w-9" alt="Transacciones">
                                        <span class="group-hover:text-gray-300">Transacciones</span>
                                    </a>
                                </li>
                                <li class="min-w-max">
                                    <a href="#"
                                        class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2990/2990468.png"
                                            class="w-9" alt="Reseñas">
                                        <span class="group-hover:text-gray-300">Reseñas</span>
                                    </a>
                                </li>
                                <li class="min-w-max">
                                    <a href="#"
                                        class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                        <img src="https://cdn-icons-png.flaticon.com/512/5917/5917200.png"
                                            class="w-9" alt="ObjetivosEconomicos">
                                        <span class="group-hover:text-gray-300">Objetivos Económicos</span>
                                    </a>
                                </li>
                                <li class="min-w-max">
                                    <a href="#"
                                        class="group flex items-center space-x-4 rounded-md px-4 py-3 text-white hover:bg-gray-800 transition-all duration-300">
                                        <img src="https://cdn-icons-png.flaticon.com/512/4703/4703578.png"
                                            class="w-9" alt="Presupuestos">
                                        <span class="group-hover:text-gray-300">Presupuestos</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
                    <main
                        class="container mx-auto mt-10 flex flex-col items-center justify-center flex-1 overflow-y-auto">
                        <h2 class="font-black text-center text-3xl mb-10">
                            @yield('titulo')
                        </h2>
                        <div class="w-full flex justify-center">
                            @yield('grafico')
                        </div>
                        <div class="w-full flex justify-center">
                            @yield('contenido')
                        </div>
                    </main>
        </div>

        {{-- <footer class=" text-center p-5 text-gray-500 font-bold uppercase bg-gray-900 w-full">
            WiseWallet - Todos los derechos reservados {{ now()->year }}
        </footer> --}}
</body>

</html>
