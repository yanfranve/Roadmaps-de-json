<!-- resources/views/password/error.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Confirmación</title>
</head>
<body>
    <h2>Error de Confirmación</h2>

   @if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
   @elseif(session('used'))
    <p style="color: red;">Este código ya fue utilizado. Genera uno nuevo.</p>
    @else
    <p style="color: red;">Código incorrecto. Inténtalo de nuevo.</p>
    @endif


    <!-- Puedes agregar más contenido o enlaces a otras partes de tu aplicación aquí -->

    <a href="{{ route('verify') }}">Volver a intentar</a>
</body>
</html>
