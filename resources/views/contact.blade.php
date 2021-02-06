@extends('plantilla')

@section('title','Contacto')

@section('content')
   <h1>contacto</h1>
   {{--  {{$errors}}  --}}
   {{--  {{var_dump($errors->any())}}  --}}
   @if ($errors->any())
      {{var_dump($errors->all())}}
   @endif
   <form action="{{route('messages.store')}}" method="POST">
      @csrf
      <input type="text" name="nombre" placeholder="nombre"><br>
      {!! $errors->first('nombre','<small>:message</small><br>')!!}
      <input type="text" name="email" placeholder="email"><br>
      {!! $errors->first('email','<small>:message</small><br>')!!}
      <input type="text" name="asunto" placeholder="asunto"><br>
      {!! $errors->first('asunto','<small>:message</small><br>')!!}
      <textarea name="mensaje" id="" cols="30" rows="5"></textarea> <br>
      {!! $errors->first('mensaje','<small>:message</small><br>')!!}
      <button type="submit">Enviar</button>
   </form>
@endsection