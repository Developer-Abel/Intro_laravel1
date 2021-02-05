<nav>
    <ul>
       <li class="{{setActive('inicio')}}"><a href="{{route('inicio')}}">Home</a></li>
       <li class="{{setActive('acerca')}}"><a href="{{route('acerca')}}">About</a></li>
       <li class="{{setActive('projects.*')}}"><a href="{{route('projects.index')}}">Portafolio</a></li>
       <li class="{{setActive('contacto')}}"><a href="{{route('contacto')}}">Contacto</a></li>
    </ul>
 </nav>