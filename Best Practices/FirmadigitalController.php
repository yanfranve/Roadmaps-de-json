<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FirmadigitalController extends Controller
{
    public function mostrarFormulario()
    {
        $rutaImagen = null; // Inicializamos la variable
        $empleado = Auth::user()->employee;

        if ($empleado) {
            $rutaImagen = $empleado->image_path;
        }

        return view('firmas.firmadigital', ['rutaImagen' => $rutaImagen]);
    }

    public function procesarCarga(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagen = $request->file('imagen');
        $rutaImagenTemporal = $imagen->store('imagenes/firmas', 'public');

        // Almacenar temporalmente la ruta de la imagen en la sesión
        session(['rutaImagenTemporal' => $rutaImagenTemporal]);

        return redirect()->route('firmas.mostrar')->with('success', 'Imagen cargada exitosamente');
    }

    public function guardarImagen()
    {
        $rutaImagenTemporal = session('rutaImagenTemporal');

        if ($rutaImagenTemporal) {
            // Mover la imagen de almacenamiento temporal a almacenamiento permanente
            $rutaImagenPermanente = $rutaImagenTemporal;
            Storage::disk('public')->move($rutaImagenTemporal, $rutaImagenPermanente);

            // Actualizar la ruta de la imagen en la base de datos
            $empleado = Auth::user()->employee;
            $empleado->update(['image_path' => $rutaImagenPermanente]);

            // Limpiar la variable de sesión
            session(['rutaImagenTemporal' => null]);

            return redirect()->route('firmas.mostrar')->with('success', 'Imagen guardada exitosamente');
        }

        return redirect()->route('firmas.mostrar')->with('error', 'Error al guardar la imagen');
    }

}
