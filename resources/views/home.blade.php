@extends('plantilla')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h1 class="dispaly-4 text-primary">Desarrollo web</h1>
                <p class="lead text-secondary">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Esse dolores repudiandae ullam provident autem et nemo, 
                    rem neque accusantium voluptate sint quaerat asperiores 
                    nobis voluptatum! Natus ipsa autem laboriosam ab!
                </p>
                <a class="btn btn-lg btn-block btn-primary" href="{{route('contacto')}}">
                    Contáctame
                </a>
                <a class="btn btn-lg btn-block btn-outline-primary" href="{{route('project.index')}}">
                    Portafólio
                </a>
            </div>
            <div class="col-12 col-lg-6">
                <img class="img-fluid mb-4 mt-3" src="/img/home.svg" alt="Desarrollo web">
            </div>
        </div>
    </div>
@endsection