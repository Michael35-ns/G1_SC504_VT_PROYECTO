<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wise Wallet</title>
    @vite('resources/css/app.css')
    @stack('styles')
</head>

<body class="h-[100vh]">
    <div class="grid h-full grid-cols-[4.5rem_4.5rem_1fr] grid-rows-[4rem_1fr] gap-x-8">
        <nav class="row-start-1 row-end-3 col-span-1 bg-gray-800 py-4">

        </nav>
        <div class="row-start-1 row-end-3 col-start-2 col-end-4 open:col-start-3">
            {{ $slot }}
        </div>

    </div>
</body>

</html>