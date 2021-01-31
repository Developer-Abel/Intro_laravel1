<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller{
   function store(Request $request){
      return $request->nombre;
   }
}
