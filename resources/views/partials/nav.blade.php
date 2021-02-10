<nav>
    <ul>
       <li class="{{setActive('inicio')}}"><a href="{{route('inicio')}}">Home</a></li>
       <li class="{{setActive('acerca')}}"><a href="{{route('acerca')}}">About</a></li>
       <li class="{{setActive('project.*')}}"><a href="{{route('project.index')}}">Portafolio</a></li>
       <li class="{{setActive('contacto')}}"><a href="{{route('contacto')}}">Contacto</a></li>
    </ul>
 </nav>