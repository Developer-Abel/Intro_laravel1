@extends('plantilla')

@section('content')
    <h1>home</h1>
    @auth
        {{auth()->user()->name}}
    @endauth
@endsection