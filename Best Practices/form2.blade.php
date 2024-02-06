@extends('layouts.app')

@section('content')
    <!-- Abre el modal automáticamente al cargar la página -->
    <script>
        $(document).ready(function(){
            $('#userInfoModal').modal('show');

            // Maneja el evento cuando se cierra el modal (ya sea por el botón de cerrar o fuera del modal)
            $('#userInfoModal').on('hidden.bs.modal', function () {
                window.location.href = '/dashboard/profile';
            });

            // Agrega un manejador de eventos al botón de cerrar dentro del modal
            $('#userInfoModal').on('click', '.btn-close', function () {
                window.location.href = '/dashboard/profile';
            });
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="userInfoModal" tabindex="-1" aria-labelledby="userInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userInfoModalLabel">Información del Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Mostrar la información del usuario -->
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Nombre:</strong> {{ $info->first_name }}</p>
                        </div>
                        <div class="col-6">
                            <p><strong>Apellidos:</strong> {{ $info->last_name }}</p>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-4">
                    <p><strong>Tipo de Documento:</strong> {{ $info->dni_type }}</p>
                    </div>
                    <div class="col-4">
                    <p><strong>Número de Identidad:</strong> {{ $info->dni }}</p>
                    </div>
                    <div class="col-4">
                    <p><strong>Lugar de Expedición:</strong> {{ $info->city_expedition }}</p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                    <p><strong>Fecha de Nacimiento:</strong> {{ $info->date_born }}</p>
                    </div>
                    <div class="col-6">
                    <p><strong>Ciudad de Nacimiento:</strong> {{ $info->city_born }}</p>
                    </div>

                </div>
                 <div class="row">
                    <div class="col-4">
                    <p><strong>Sexo:</strong> {{ $info->sex }}</p>
                    </div>
                    <div class="col-4">
                    <p><strong>Tipo de Sangre:</strong> {{ $info->blood_type }}</p>
                    </div>
                    <div class="col-4">
                    <p><strong>Género:</strong> {{ $info->gender }}</p>
                    </div>

                </div>


                    <!-- Verificar si nació en el extranjero y mostrar información adicional si es el caso -->
                    @if($info->foreing)
                        <p><strong>País de Nacimiento:</strong> {{ $info->country_foreing }}</p>
                        <p><strong>Ciudad de Nacimiento en el Extranjero:</strong> {{ $info->origin_foreing }}</p>
                    @endif

                    <!-- Agrega el campo de correo electrónico del formulario -->
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" required>
                </div>

                <div class="modal-footer">
                    <!-- Agrega el formulario dentro del modal -->
                    <form action="/send-code" method="post">
                        @csrf
                        <!-- El contenido del formulario se ha movido al cuerpo del modal -->

                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> --}}
                        <button type="submit" class="btn btn-primary">Enviar Código</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(session('status'))
        <p>{{ session('status') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
@endsection

<!-- resources/views/password/success.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éxito de Confirmación</title>
</head>
<body>
    <h2>Éxito de Confirmación</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @else
        <p style="color: green;">La confirmación ha sido exitosa.</p>
    @endif

    <!-- Puedes agregar más contenido o enlaces a otras partes de tu aplicación aquí -->

    <a href="{{ route('verify') }}">Volver</a>
</body>
</html>



