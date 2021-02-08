@extends('plantilla')

@section('title','Crear proyecto')

@section('content')
   <h1>Editar proyecto</h1>
    @if ($errors->any())
        
      <ul>
         @foreach ($errors->all() as $error)
             <li>{{$error}}</li>
         @endforeach
      </ul>
    @endif
   <form action="{{route('project.update', $project)}}" method="POST">
    @csrf @method('PATCH')
       <label for="">Título <br> <input type="text" name="title" value="{{old('title',$project->title)}}"></label> <br>
       <label for="">Url <br> <input type="text" name="url" value="{{old('url',$project->url)}}"></label> <br>
       <label for="">Descripción <br> <textarea name="description"  id="" cols="20" rows="5">{{old('description',$project->description)}}</textarea></label> <br> <br>
       <button>Actualizar</button>
    </form>
@endsection