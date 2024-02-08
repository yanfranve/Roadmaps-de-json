<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captura de Firma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h2>Captura de Firma</h2>
        <canvas id="firmaCanvas" width="400" height="200" style="border:1px solid #000;"></canvas>
        <div class="mt-3">
            <button id="guardarFirma" class="btn btn-primary">Guardar Firma</button>
            <button id="borrarFirma" class="btn btn-secondary">Borrar Firma</button>
        </div>
    </div>

    <!-- Agrega jQuery desde un CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Agrega SignaturePad desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@3.0.0/dist/signature_pad.min.js"></script>

    <script>
        $(document).ready(function () {
            var canvas = document.getElementById('firmaCanvas');
            var signaturePad = new SignaturePad(canvas);

            // Botón para borrar la firma
            $('#borrarFirma').on('click', function () {
                signaturePad.clear();
            });

            // Guardar la firma
            $('#guardarFirma').on('click', function () {
                var firmaData = signaturePad.toDataURL();

                $.post('/guardar-firma', { firma: firmaData }, function (response) {
                    // Manejar la respuesta del servidor, redirigir o mostrar un mensaje de éxito
                    console.log(response);
                });
            });
        });
    </script>

</body>
</html>
