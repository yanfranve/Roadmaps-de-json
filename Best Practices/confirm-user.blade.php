@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formulario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Mostrar mensajes de éxito o error -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <!-- Tu formulario aquí -->
                        <form action="{{ route('confirm-user.procesar') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class=" col-6 mb-3">
                                    <label for="apellido" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                                </div>

                            </div>
                            <div class ="row">

                         {{-- <div class="col-6">
                          <label class="form-label" for="dni_type">Tipo de documento</label>
                          <input type="text" class="form-control" id="numero_documento" name="numero_documento" required>

                            </div> --}}

                            <div class="col-6 mb-3">
                            <label for="numero_documento" class="form-label">Número de Documento</label>
                            <input type="text" class="form-control" id="numero_documento" name="numero_documento" required>
                            </div>
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agrega el script para abrir automáticamente el modal al cargar la página -->
    <script>
        $(document).ready(function(){
            $('#myModal').modal('show');

        });
    </script>
@endsection
