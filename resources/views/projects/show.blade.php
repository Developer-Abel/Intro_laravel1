@extends('plantilla')

@section('title', 'Portafolio |'. $project->title)

@section('content')
   <div class="container">
      <div class="bg-white p-5 shadow rounded">
         <h1>{{$project->title}}</h1>
         <p class="text-secondary">
            {{$project->description}}
         </p>
         <p class="text-black-50">
            {{$project->created_at->diffForHumans()}}
         </p>   
         <div class="d-flex justify-content-between align-items-center">
            <a class="" href="{{route('project.index')}}">Regresar</a>
            @auth
               <div class="btn-group btn-group-sm">
                  <a class="btn btn-primary" href="{{route('project.edit',$project)}}">
                     Editar
                  </a>
                  <a class="btn btn-danger" href="#" onclick="document.getElemtById('delete-project').submit()">
                     Eliminar
                  </a>
               </div>
               <form action="{{route('project.destroy',$project)}}" id="delete-project" method="POST" class="d-none">

                  @csrf @method('DELETE')
               </form>
            @endauth
         </div>
      </div>   
   </div>
@endsection