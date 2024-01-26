<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactoMailable;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function pintarFormulario(){
        return view('email.formulario');
    }
    public function procesarFormulario(Request $request){
        $request->validate([
            'nombre' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email'],
            'contenido' => ['required', 'string', 'min:10']
        ]);
        try {
            Mail::to("admin@mail.es")->send(new ContactoMailable(ucwords($request->nombre), $request->email,ucfirst($request->contenido) ));
            return redirect()->route('films.index')->with('info', 'Correo enviado');
        } catch (\Throwable $th) {
            /* dd("Error: ".$ex->getMessage()) */ //Para depurar
            return redirect()->route('films.index')->with('info', 'El correo no se ha enviado. Intentelo de nuevo mas tarde');
        }
    }
}
