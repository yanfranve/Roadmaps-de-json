@extends('layouts.app')

@section('content')
    <div class="modal" id="generarFirmaModal" tabindex="-1" aria-labelledby="generarFirmaModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="generarFirmaModalLabel">Vamos a generar tu firma electrónica</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-6">Primero, carga una imagen de tu firma o dibuja tu firma.</p>

                    <div class="mb-3 me-2">
                        <!-- Aquí puedes colocar tus campos para cargar la firma o dibujarla -->
                        <button onclick="window.location='{{ route('firmas.firmadigital') }}'" class="btn btn-primary">Cargar Firma</button>
                        <button onclick="window.location='{{ route('signature') }}'" class="btn btn-primary">Dibujar Firma</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="window.location='{{ route('profile') }}'" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
     <script>
        $(document).ready(function () {
            $('#generarFirmaModal').modal('show');
        });
    </script>
@endsection

