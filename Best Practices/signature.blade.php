@extends('layouts.app')

@section('content')
    <section class="signature-component">
        <h1>Dibujar firma</h1>
        <h2>con el mouse o táctil</h2>

        <canvas id="signature-pad" width="400" height="200"></canvas>

        <div>
            <button id="save" class="btn btn-primary">Guardar</button>
            <button id="clear" class="btn btn-primary">Limpiar</button>
            <button onclick="window.location='{{ route('profile') }}'" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

        </div>

        {{-- <p>
            <br />
            <a href="\resources\js\signature.js" target="_blank">Ejemplo de throttling sin retraso aquí</a><br />
            <br />
            <a href="https://github.com/szimek/signature_pad" target="_blank">Signature Pad</a> con simplificación y throttling personalizados.
        </p> --}}
    </section>



    <!-- Incluir el script de signature.js -->
    <script src="{{ mix('js/app.js') }}"></script>
   <script src="{{ mix('js/signature.js') }}"></script>

   {{-- <script src="node_modules/signature_pad/dist/signature_pad.umd.js"></script> --}}



    <script>
        document.getElementById('save').addEventListener('click', function () {

            // Redirige a la ruta 'password.form'
            window.location.href = "{{ route('password.form') }}";
        });
         document.getElementById('clear').addEventListener('click', function () {

            // Redirige a la ruta 'password.form'
            window.location.href = "{{ route('signature') }}";
        });

    </script>
@endsection
@section('scripts')
<script>
    Swal.fire(
  title: "The Internet?",
  text: "That thing is still around?",
  icon: "question"
)
</script>
@endsection
