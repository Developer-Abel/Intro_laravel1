@extends('plantilla')

@section('title','Crear proyecto')

@section('content')
   <h1>Crear nuevo proyecto</h1>
    @if ($errors->any())
        
      <ul>
         @foreach ($errors->all() as $error)
             <li>{{$error}}</li>
         @endforeach
      </ul>
    @endif
   <form action="{{route('projects.store')}}" method="POST">
    @csrf
       <label for="">Título <br> <input type="text" name="title" value="{{old('title')}}"></label> <br>
       <label for="">Url <br> <input type="text" name="url" value="{{old('url')}}"></label> <br>
       <label for="">Descripción <br> <textarea name="description" id="" cols="20" rows="5">{{old('description')}}</textarea></label> <br> <br>
       <button>Guardar</button>
   </form>
@endsection