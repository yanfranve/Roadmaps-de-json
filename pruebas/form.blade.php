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
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <h6 class="modal-title " id="userInfoModalLabel"> verifique sus datos  sin son correcto coloque su correo   </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Mostrar la información del usuario -->
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Nombres:</label>
                            <div class="card rounded-4 border text-center">
                              <p class="m-0">{{ $info->first_name }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Apellidos:</label>
                            <div class="card rounded-4 border text-center">
                            <p class="m-0"> {{ $info->last_name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-4">
                        <label class="form-label">Tipo de Documento:</label>
                        <div class="card rounded-4 border text-center">
                    <p class="m-0"> {{ $info->dni_type }}</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Número de Identidad:</label>
                        <div class="card rounded-4 border text-center">
                    <p class="m-0"> {{ $info->dni }}</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Lugar de Expedición:</label>
                        <div class="card rounded-4 border text-center">
                    <p class="m-0"> {{ $info->city_expedition }}</p>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Fecha de Nacimiento:</label>
                        <div class="card rounded-4 border text-center">
                    <p class="m-0"> {{ $info->date_born }}</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Ciudad de Nacimiento:</label>
                        <div class="card rounded-4 border text-center">
                    <p class="m-0"> {{ $info->city_born }}</p>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-4">
                        <label class="form-label">Sexo:</label>
                        <div class="card rounded-4 border text-center">
                    <p class="m-0"> {{ $info->sex }}</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Tipo de Sangre:</label>
                        <div class="card rounded-4 border text-center">
                    <p class="m-0"> {{ $info->blood_type }}</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Género:</label>
                        <div class="card rounded-4 border text-center">
                    <p class="m-0"> {{ $info->gender }}</p>
                        </div>
                    </div>

                </div>


                    <!-- Verificar si nació en el extranjero y mostrar información adicional si es el caso -->
                    @if($info->foreing)
                        <p><strong>País de Nacimiento:</strong> {{ $info->country_foreing }}</p>
                        <p><strong>Ciudad de Nacimiento en el Extranjero:</strong> {{ $info->origin_foreing }}</p>
                    @endif
                <form action="/send-code" method="post">
                    <!-- Agrega el campo de correo electrónico del formulario -->
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" required>
                </div>

                <div class="modal-footer">
                    <!-- Agrega el formulario dentro del modal -->

                        @csrf
                        <!-- El contenido del formulario se ha movido al cuerpo del modal -->

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
@section('scripts')
<script>
    Swal.fire(
  title: "The Internet?",
  text: "That thing is still around?",
  icon: "question"
)
</script>
@endsection
