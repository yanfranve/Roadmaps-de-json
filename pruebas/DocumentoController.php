<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DocumentoController extends Controller
{
    public function index()
    {
        return view('documentos.index');
    }
    // public function show($id)
    // {
    //     $document = Documento::findOrFail($id);
    //     return view('documents.show', compact('documento'));
    // }
    public function cargaDePDF()
    {
        $documentos = Documento::all(); // Obtener todos los documentos (asegúrate de que el modelo y la tabla existan)

        // Obtener nombres de archivos de la carpeta "archivos"
        $archivos = array_diff(scandir(public_path('archivos')), ['..', '.']); // Obtiene los nombres de archivos ignorando los directorios '.' y '..'

        return view('documentos', ['documentos' => $documentos, 'archivos' => $archivos]);
        // Pasar la colección de documentos y los nombres de archivos a la vista
    }

    public function upload(Request $request)
    {
        // Verificamos si se ha enviado un archivo PDF
        if ($request->hasFile('documento') && $request->file('documento')->isValid()) {
            // Procesamos el archivo
            $archivo = $request->file('documento');
            $nombreArchivo = $archivo->getClientOriginalName();

            // Movemos el archivo a la carpeta deseada
            $archivo->move(public_path('archivos'), $nombreArchivo);

            // Aquí puedes almacenar el nombre del archivo en la base de datos u otra lógica que desees
            // Por ejemplo, puedes guardar el nombre del archivo en la base de datos para asociarlo con el usuario o el documento específico
            // Esto dependerá de la estructura de tu aplicación y de tus necesidades específicas

            return redirect()->back()->with('success', 'El archivo se ha cargado correctamente.');
        } else {
            // Si no se ha enviado un archivo válido, redireccionamos de vuelta con un mensaje de error
            return redirect()->back()->with('error', 'No se ha enviado un archivo válido.');
        }
    }
    public function delete($filename)
    {
        $filePath = public_path('archivos/' . $filename);

        if (file_exists($filePath)) {
            unlink($filePath);
            return redirect()->back()->with('success', 'No se ha enviado un archivo válido.');

        }

        // Redireccionar o devolver una respuesta, según sea necesario
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|file',
        ]);

        $documento = $request->file('documento');
        $contenidoDocumento = base64_encode(file_get_contents($documento->path()));

        $hash = hash_file('sha256', $documento);

        $documentoModel = new Documento();
        $documentoModel->nombre = $documento->getClientOriginalName();
        $documentoModel->hash = $hash;
        $documentoModel->contenido = $contenidoDocumento;

        $documentoModel->save();

        return response()->json(['message' => 'Documento subido exitosamente']);

    }
}
