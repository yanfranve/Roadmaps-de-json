<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Código</title>
    <!-- Agrega los estilos de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Modal -->
    <div class="modal fade" id="confirmCodeModal" tabindex="-1" aria-labelledby="confirmCodeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmCodeModalLabel">Confirmación de Código</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <!-- Muestra mensajes de éxito o error -->
                    @if(session('success'))
                        <p style="color: green;">{{ session('success') }}</p>
                    @endif

                    @if(session('error'))
                        <p style="color: red;">{{ session('error') }}</p>
                    @endif

                    <!-- Formulario de confirmación -->
                    <form method="POST" action="{{ url('/confirm-code') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" name="email" value="{{ $email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">Código de Verificación:</label>
                            <input type="text" class="form-control" name="code" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Verificar Código</button>
                    </form>
                     @if (session('flash_notification.message'))
                  <div class="alert alert-{{ session('flash_notification.level') }}">
                     {{ session('flash_notification.message') }}
                  </div>
                 @endif

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Agrega los scripts de Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Script para mostrar el modal automáticamente -->
    <script>
        // Utiliza el ID del modal para mostrarlo al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('confirmCodeModal'));
            myModal.show();
        });
    </script>

</body>
</html>
