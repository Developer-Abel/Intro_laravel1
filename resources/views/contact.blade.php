@extends('plantilla')

@section('title','Contacto')

@section('content')
   <h1>contacto</h1>
   <form action="{{route('contacto')}}" method="POST">
      @csrf
      <input type="text" name="nombre" placeholder="nombre"><br>
      <input type="text" name="asunto" placeholder="asunto"><br>
      <input type="text" name="email" placeholder="email"><br>
      <textarea name="mensaje" id="" cols="30" rows="5">Mensaje</textarea> <br>
      <button type="submit">Enviar</button>
   </form>
@endsection