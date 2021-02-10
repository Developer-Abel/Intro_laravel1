@extends('plantilla')

@section('title', 'Portafolio |'. $project->title)

@section('content')
    <h1>{{$project->title}}</h1>
    <a href="{{route('project.edit',$project)}}">Editar</a>
    <form action="{{route('project.destroy',$project)}}" method="POST">
        @csrf @method('DELETE')
        <button>Eliminar</button>
    </form>
    <p>{{$project->description}}</p>
    <p>{{$project->created_at->diffForHumans()}}</p>
@endsection