<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Agregar enlaces a tus estilos CSS aquí -->
</head>
<body>
    <header>
        <!-- Agregar contenido del encabezado aquí -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/formulario.js'])
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Agregar contenido del pie de página aquí -->
    </footer>
</body>
</html>
