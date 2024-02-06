@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Cargar imagen de tu firma</h2>
        <form action="{{ route('password.form') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="files" class="form-label">Selecciona tu imagen:</label>
                <input type="file" id="files" name="files" accept="image/png, .jpeg, .jpg, image/gif">
            </div>
            <div id="list" class="mb-3"></div>
            <button type="submit" class="btn btn-primary">Guardar Firma</button>
            <button onclick="window.location='{{ route('profile') }}'" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            @if(session('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>

            @endif
        </form>
    </div>

    <script>
        function archivo(evt) {
            var files = evt.target.files; // FileList object

            // Obtenemos la imagen del campo "file".
            for (var i = 0, f; f = files[i]; i++) {
                // Solo admitimos imágenes.
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();

                reader.onload = (function (theFile) {
                    return function (e) {
                        // Insertamos la imagen
                        document.getElementById("list").innerHTML = ['<img class="img-circle"  style=" width: 305px; height:300px;" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
                    };
                })(f);

                reader.readAsDataURL(f);
            }
        }

        document.getElementById('files').addEventListener('change', archivo, false);
    </script>
@endsection
