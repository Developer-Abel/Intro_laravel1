@extends('plantilla')

@section('title','Portafolio')

@section('content')
   <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-3">
         <h1 class="display-4 mb-0">Portafolio</h1>
         @auth
            <a class="btn btn-primary" href="{{route('project.create')}}">Nuevo proyecto</a>
         @endauth
      </div>
      <p class="lead text-secondary">Proyectos realizados Lorem ipsum dolor sit amet
         consectetur adipisicing elit. Illo praesentium vel Lorem ipsum dolor sit. 
      </p>

      <ul class="list-group">
         @forelse ($proyectos as $proyecto)
            <li class="list-group-item border-0 mb-3 shadow-sm">
               <a class="d-flex justify-content-between align-items-center text-secondary" href="{{route('project.show',$proyecto)}}">
                  <span class=" font-weight-bold">
                     {{$proyecto->title}}
                  </span>
                  <span class="text-black-50">
                     {{$proyecto->created_at->format('d/m/y')}}
                  </span>
               </a>
            </li>
         @empty
            <li class="list-group-item border-0 mb-3 shadow-sm">
               No hay proyectos
            </li>
         @endforelse
         {{$proyectos->links()}}
      </ul>
   </div>
@endsection