@extends('plantilla')

@section('title','Portafolio')

@section('content')
   <h1>Portafolio</h1>
      <a href="{{route('projects.create')}}">Nuevo proyecto</a>
      <br>
      @forelse ($proyectos as $proyecto)
      <li><a href="{{route('projects.show',$proyecto)}}">{{$proyecto->title}}</a></li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
      {{$proyectos->links()}}
@endsection