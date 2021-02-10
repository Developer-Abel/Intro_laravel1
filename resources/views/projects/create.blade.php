@extends('plantilla')

@section('title','Crear proyecto')

@section('content')
   <h1>Crear nuevo proyecto</h1>
   @include('partials/validation-errors')
   <form action="{{route('project.store')}}" method="POST">

      @include('projects/_form',['btnText' => 'Guardar'])
   </form>
@endsection