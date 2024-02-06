<!-- resources/views/password/confirm_code.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Código</title>
</head>
<body>
    <h2>Confirmación de Código</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Agrega el formulario de confirmación -->
    <form method="POST" action="{{ url('/confirm-code') }}">
        @csrf
        <label for="code">Código de Verificación:</label>
        <input type="text" name="code" placeholder="Ingrese el código recibido">
        <button type="submit">Confirmar código</button>
    </form>
</body>
</html>
