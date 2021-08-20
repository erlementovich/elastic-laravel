<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<div id="app" style="font-family: sans-serif">
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
