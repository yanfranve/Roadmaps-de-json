<?php

namespace App\Http\Controllers;

class FirmaController extends Controller
{
    public function mostrarFormulario()
    {
        return view('firmas.generar-firma');
    }

}
