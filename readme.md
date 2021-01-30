# CURSO LARAVEL 

### Nombrando rutas
Al definir las rutas en laravel podemos modificar la ruta las veces que sea necesario
y en los links solo hacer referencia a la ruta.

:::php
Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');
Route::view('/portfolio','portfolio')->name('portafolio');
Route::view('/contact','contact')->name('contacto');

:::html
<nav>
    <ul>
    <li><a href="{{route('/')}}">Home</a></li>
    <li><a href="{{route('acerca')}}">About</a></li>
    <li><a href="{{route('portafolio')}}">Portafolio</a></li>
    <li><a href="{{route('contacto')}}">Contacto</a></li>
    </ul>
</nav>

Para que esto funcione en los **href** se inserta le **route** 