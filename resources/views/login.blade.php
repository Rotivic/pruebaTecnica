@extends('layout')

@section('title', 'Login')

@section('content')

<div class="container" style="max-width: 400px;">
    <h1>Login</h1>

    <form method="POST" action="{{ route('inicio-sesion') }}" >
        @csrf
        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="text" name="dni" id="dni" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary my-2">Login</button>
    </form>
</div>

@endsection
