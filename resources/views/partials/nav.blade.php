<nav>
    <ul>
       <li class="{{setActive('inicio')}}"><a href="/">Home</a></li>
       <li class="{{setActive('acerca')}}"><a href="/about">About</a></li>
       <li class="{{setActive('portafolio')}}"><a href="{{route('portafolio')}}">Portafolio</a></li>
       <li class="{{setActive('contacto')}}"><a href="{{url('contact')}}">Contacto</a></li>
    </ul>
 </nav>