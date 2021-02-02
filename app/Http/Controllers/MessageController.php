<?php

namespace App\Http\Controllers;

use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MessageController extends Controller{
   function store(Request $request){
      $message = request()->validate([
         'nombre' => 'required',
         'email' => 'required',
         'asunto' => 'required',
         'mensaje' => 'required |min:3'
      ],
      [
         'nombre.required' => 'Necesito tu nombre',
         'mensaje.required' => 'Necesito tu mensaje',
         'mensaje.min' => 'Ingresa almenos 3 letras',
         
      ]
   );

   // Mail::to('abel@gmail.com')->queue(New MessageReceived($message));
   return new MessageReceived($message);
      return "Mensaje enviado";
   }
}

