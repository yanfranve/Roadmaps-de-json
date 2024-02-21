@extends('layouts.app')

@section('content')

<div class="modal fade" id="imagenModal" tabindex="-1" aria-labelledby="imagenModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imagenModalLabel">Cargar imagen de tu firma</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formImagen" action="{{ route('firmas.procesar') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="files" class="form-label">Selecciona tu imagen:</label>
            <input type="file" id="files" name="files" accept="image/png, .jpeg, .jpg, image/gif">
          </div>
          <div id="list" class="mb-3"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="guardarFirma()" class="btn btn-primary">Guardar Firma</button>
        <button type="button" onclick="cancelarCarga()" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var miModal = new bootstrap.Modal(document.getElementById('imagenModal'));
    miModal.show();
  });

  function archivo(evt) {
    var files = evt.target.files;
    for (var i = 0, f; f = files[i]; i++) {
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      reader.onload = (function (theFile) {
        return function (e) {
          document.getElementById("list").innerHTML = ['<img class="img-circle" style=" width: 305px; height:300px;" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
        };
      })(f);

      reader.readAsDataURL(f);
    }
  }

  document.getElementById('files').addEventListener('change', archivo, false);

 function guardarFirma() {
    // Validar si se ha cargado una imagen
  var fileInput = document.getElementById('files');
  if (fileInput.files.length === 0) {
    // Mostrar mensaje de error con SweetAlert2
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Por favor, selecciona una imagen antes de guardar la firma.',
    });
    return; // Detener la ejecución de la función si no hay imagen seleccionada
  }
  Swal.fire({
    title: '¿Quieres guardar esta Firma?',
    text: 'Una vez guardada no acepta cambios ',
    showCancelButton: true,
    confirmButtonText: 'Guardar',
    cancelButtonText: 'Cancelar',
    icon: 'question'
  }).then((result) => {
    if (result.isConfirmed) {
      // ...
      var formData = new FormData(document.getElementById('formImagen'));

      fetch("{{ route('firmas.procesar') }}", {
        method: 'POST',
        body: formData
      }).then((response) => {
        if (response.ok) {
          // Mostrar mensaje de éxito con SweetAlert2
          Swal.fire({
            position: 'center',
            icon: "success",
            title: "Firma guardada correctamente",
            showConfirmButton: false,
            timer: 1500
          }).then(() => {
            // Redireccionar al cliente a la ruta password.form
            window.location.href = "/dashboard/password/form";
          });
        } else {
          // Mostrar mensaje de error
          Swal.fire({
            position: 'center',
            icon: "error",
            title: "Error al guardar la firma",
            text: response.statusText
          });
        }
      });
    } else {
      // Cancelar la operación
    }
  });
}


  function cancelarCarga() {
    window.location = '{{ route('firmas.firmadigital') }}';  // Redirect to password.form
  }
</script>

@if(session('success'))
  <script>
    Swal.fire({
      position: "top-end",
      icon: "success",
      title: "Tu trabajo ha sido guardado",
      showConfirmButton: false,
      timer: 1500,
      onClose: () => {
        window.location = '{{ route('password.form') }}';  // Redirect to password.form after success
      }
    });
  </script>
@endif

@if(session('error'))
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '{{ session("error") }}',
    });
  </script>
@else
  @endif


