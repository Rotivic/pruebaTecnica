@extends('layout')

@section('title', 'Página de formulario')

@section('scripts')
    <script src="{{ asset('js/formulario.js') }}"></script>
@endsection

@section('content')



@if(session('success'))
    <div id="successAlert" class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
        {{ session('success') }}
        
    </div>
@endif

@if ($errors->any())
    <div id="errorAlert" class="alert alert-danger alert-dismissible fade show floating-alert" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container" style="max-width: 400px;">
    <h1>Formulario</h1>

    <form action="{{ route('procesar.formulario') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ session('user')->name ?? '' }}" class="form-control" style="width: 100%;">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ session('user')->email ?? '' }}" class="form-control" style="width: 100%;">
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="firma">Firma:</label>
            <canvas id="firma" name="firma" width="400" height="200" style="border:1px solid #000; display: block;"></canvas>
        </div>

        <input type="hidden" id="sign" name="sign">

        <button type="button" class="btn btn-secondary mb-2" id="clearButton">Limpiar firma</button>
        <button type="submit" class="btn btn-primary mb-2">Enviar formulario</button>
    </form>
</div>
@endsection
