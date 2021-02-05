@extends('plantilla')

@section('title','Portafolio')

@section('content')
   <h1>Portafolio</h1>
      @forelse ($proyectos as $proyecto)
      <li>{{$proyecto->title}}</li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
      {{$proyectos->links()}}
@endsection