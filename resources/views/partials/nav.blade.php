<nav>
    <ul>
       <li class="{{setActive('inicio')}}"><a href="{{route('inicio')}}">Home</a></li>
       <li class="{{setActive('acerca')}}"><a href="{{route('acerca')}}">About</a></li>
       <li class="{{setActive('project.*')}}"><a href="{{route('project.index')}}">Portafolio</a></li>
       <li class="{{setActive('contacto')}}"><a href="{{route('contacto')}}">Contacto</a></li>
       @guest
         <li> <a href="{{route('login')}}">Login</a> </li>
       @else
       <li> <a href="#" onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">Cerrar Sesión</a></li>
       @endguest

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
      </form>
    </ul>
 </nav>