@extends('plantilla')

@section('title','Portafolio')

@section('content')
   <h1>Portafolio</h1>
      @auth
         <a href="{{route('project.create')}}">Nuevo proyecto</a>
      @endauth
      <br>
      @forelse ($proyectos as $proyecto)
      <li><a href="{{route('project.show',$proyecto)}}">{{$proyecto->title}}</a></li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
      {{$proyectos->links()}}
@endsection