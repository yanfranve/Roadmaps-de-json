@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cargar Documento</div>

                <div class="card-body">
                    <form action="{{ route('documentos.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="documento">Seleccionar archivo PDF:</label>
                            <input type="file" class="form-control-file" id="documento" name="documento" accept="application/pdf">
                        </div>

                        <button type="submit" class="btn btn-primary">Subir Documento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($archivos))
    <div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Documentos Cargados</div>

            <div class="card-body text-left">
                <ul class="list-group">
                    @foreach ($archivos as $archivo)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-pdf fa-lg mr-2"></i>
                            <span class="mr-2">{{ $archivo }}</span>
                        </div>
                        <div>
                           <button class="btn btn-primary btn-sm mr-2" onclick="mostrarDocumento('{{ asset('archivos/' . $archivo) }}')">
                <i class="fas fa-eye"></i> <!-- Icono para visualizar -->
                           </button>
                            <!-- Formulario de eliminación -->
                           <form id="deleteForm" action="{{ route('archivos.delete', $archivo) }}" method="POST">
                            @csrf
                            @method('DELETE')
                             <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminar()"> <!-- Cambiado a type="button" y evento onclick -->
                                <i class="fas fa-trash"></i> <!-- Icono de eliminar -->
                            </button>

                                </form>
                        </div>
                    </li>
                    @endforeach
                </ul>

                @if (!empty($archivos))
                <button type="button" class="btn btn-primary mt-3">Continuar</button>
                @else
                <button type="button" class="btn btn-primary mt-3" disabled>Continuar</button>
                @endif
            </div>
        </div>
    </div>
</div>
<div id="visorDocumento" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Documento</h5>
                <a href="{{ route('documentos.cargaDePDF') }}" class="btn btn-secondary mt-3">Regresar</a>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="iframeDocumento" src="" style="width: 100%; height: 500px;" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>


</div>
    @endif
</div>
<script>
    function confirmarEliminar(){

        Swal.fire({
  title: "¿Estás seguro?",
  text: "¡No podrás revertir esto!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Sí, eliminarlo",
  cancelButtonText: 'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
    document.getElementById('deleteForm').submit();
    Swal.fire({
      title: "Eliminado!",
      text: "Su Documento fue Eliminado Exitosamente .",
      icon: "success",
      timer: 4000

      });
      }
    });

}








    // Manejar la respuesta después de enviar el formulario de eliminación
    // if (session('success')){
    //     Swal.fire({
    //     title: '¡Eliminado!',
    //     text: '{{ session('success') }}',
    //     icon: 'success'
    // }).then(() => {
    //     // Redirigir a la ruta documentos.cargaDePDF
    //     window.location.href = "{{ route('documentos.cargaDePDF') }}";
    // });



    // }


</script>
<script>
    function mostrarDocumento(url) {
        document.getElementById('iframeDocumento').src = url;
        $('#visorDocumento').modal('show');
    }
</script>

@endsection
