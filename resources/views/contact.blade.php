@extends('plantilla')

@section('title','Contacto')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-12 col-sm-10 col-lg-10 mx-auto">
            <form class="bg-white shadow rounded py-3 px-4" action="{{route('messages.store')}}" method="POST">
               @csrf
               <h1 class="display-4">contacto</h1>
               <div class="form-group">
                  <label for="name">Nombre</label>
                  <input class="form-control bg-light shadow-sm
                  @error('nombre') is-invalid @else border-0 @enderror" 
                  type="text" name="nombre" id="name" placeholder="nombre">
                  @error('nombre')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{$message}}</strong>
                      </span>
                  @enderror
               </div>
      
               <div class="form-group">
                  <label for="name">Email</label>
                  <input class="form-control bg-light shadow-sm
                  @error('email') is-invalid @else border-0 @enderror" 
                  type="text" name="email" id="email" placeholder="email">
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{$message}}</strong>
                      </span>
                  @enderror
               </div>
      
               <div class="form-group">
                  <label for="asunto">Asunto</label>
                  <input class="form-control bg-light shadow-sm
                  @error('asunto') is-invalid @else border-0 @enderror"
                  type="text" name="asunto" id="asunto" placeholder="asunto">
                  @error('asunto')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{$message}}</strong>
                      </span>
                  @enderror
               </div>
      
               <div class="form-group">
                  <label for="mensaje">Contenido</label>
                  <textarea class="form-control bg-light shadow-sm
                  @error('mensaje') is-invalid @else border-0 @enderror" 
                  name="mensaje" id="mensaje" cols="30" rows="5"></textarea>
                  @error('mensaje')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{$message}}</strong>
                      </span>
                  @enderror
               </div>
               <button class="btn btn-primary btn-lg btn-block" type="submit">Enviar</button>
            </form>
         </div>
      </div>
   </div>
@endsection