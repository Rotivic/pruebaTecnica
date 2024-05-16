@extends('layout')


@section('scripts')
    <script src="{{ asset('js/formulario.js') }}"></script>
@endsection

@section('title', 'Página de formulario')

@section('content')

<div class="container" style="max-width: 400px;">
    <h1>Formulario</h1>

    <form action="{{ route('procesar.formulario') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="{{ old('name', session('user')['name'] ?? '') }}" class="form-control @error('name') is-invalid @enderror" style="width: 100%;">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', session('user')['email'] ?? '') }}" class="form-control @error('email') is-invalid @enderror" style="width: 100%;">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="firma">Firma:</label>
            <canvas id="firma" name="firma" width="400" height="200" style="border:1px solid #000; display: block;"></canvas>
            @error('sign')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="hidden" id="sign" name="sign">
        </div>


        <button type="button" class="btn btn-secondary mb-2" id="clearButton">Limpiar firma</button>
        <button type="submit" class="btn btn-primary mb-2">Enviar formulario</button>

    </form>
</div>

@endsection
