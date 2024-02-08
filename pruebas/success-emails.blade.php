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
