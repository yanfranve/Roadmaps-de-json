@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Éxito de Confirmación</h2>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
            <!-- Aviso adicional si existe un mensaje de éxito en la sesión -->
            <p>¡Gracias por confirmar! Estamos procesando su solicitud. Espere pacientemente.</p>
        @else
            <p style="color: green;">La confirmación ha sido exitosa.</p>
        @endif

        <!-- Puedes agregar más contenido o enlaces a otras partes de tu aplicación aquí -->

        <a href="{{ route('confirm-user.show') }}" class="btn btn-primary">Aceptar</a>

        <!-- Agregando el otro llamado -->
        <a href="{{ route('confirm-user.show') }}" class="btn btn-secondary">Otro Método</a>

    </div>
@endsection
