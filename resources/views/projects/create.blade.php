@extends('plantilla')

@section('title','Crear proyecto')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-12 col-sm-10 col-lg-10 mx-auto">
            @include('partials/validation-errors')
            <form class="bg-white py-3 px-4 shadow rounded" action="{{route('project.store')}}" method="POST">
               <h1 class="display-4">Nuevo proyecto</h1>
               <hr>
               @include('projects/_form',['btnText' => 'Guardar'])
            </form>
         </div>
      </div>
   </div>
@endsection