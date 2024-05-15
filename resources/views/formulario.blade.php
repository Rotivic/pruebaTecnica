@extends('layout')

@section('title', 'Página de formulario')

@section('scripts')
    <script src="{{ asset('js/formulario.js') }}"></script>
@endsection

@section('content')

<h1>Formulario</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('procesar.formulario') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="vic" readonly><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="victormfdezfdez@gmail.com" readonly><br><br>

        <label for="dni">Dni:</label><br>
        <input type="dni" id="dni" name="dni" value="20953272L" readonly><br><br>

        <label for="firma">Firma:</label><br>
        <canvas id="firma" name="firma" width="400" height="200" style="border:1px solid #000;"></canvas><br><br>
        <input type="hidden" id="sign" name="sign">

        <button type="submit">Enviar formulario</button>
    </form>


@endsection


  
