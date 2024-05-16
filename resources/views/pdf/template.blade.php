<style>
    body {
        font-family: Arial, sans-serif;
    }
    h1 {
        color: #333;
    }
    p {
        margin-bottom: 10px;
    }
    img {
        max-width: 100%;
        height: auto;
    }
</style>

<h1>Contenido de su formulario:</h1>
<p>Nombre: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>
<img src="{{ $user->sign }}" alt="Canvas Image">
