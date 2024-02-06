<!-- resources/views/firmas/firmadigital.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(isset($rutaImagen))
            <h2>Imagen Cargada</h2>
            <img src="{{ asset('storage/' . $rutaImagen) }}" class="img-fluid mb-3" alt="Imagen Cargada">

            <div class="mt-3">
                <a href="{{ route('firmas.firmadigital') }}" class="btn btn-secondary">Retroceder</a>

                <form action="{{ route('password.form') }}" method="post" class="d-inline">
                    @csrf
                    <input type="hidden" name="rutaImagen" value="{{ $rutaImagen }}">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        @else
            <h2>No hay imagen cargada</h2>
            <p>Por favor, carga una imagen primero.</p>

            <a href="{{ route('firmas.firmadigital') }}" class="btn btn-secondary">Retroceder</a>
        @endif
    </div>
@endsection
