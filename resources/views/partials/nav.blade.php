
<nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
   <div class="container">
      <a class="navbar-brand*" href="{{route('home')}}"> {{config('app.name')}}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="nav nav-pills">
            <li class="nav-item ">
               <a class="nav-link {{setActive('inicio')}}" href="{{route('inicio')}}">Home</a>
            </li>

            <li class="nav-item">
               <a class="nav-link {{setActive('acerca')}}" href="{{route('acerca')}}">About</a>
            </li>

            <li class="nav-item">
               <a class="nav-link {{setActive('project.*')}}" href="{{route('project.index')}}">Portafolio</a>
            </li>

            <li class="nav-item">
               <a class="nav-link {{setActive('contacto')}}" href="{{route('contacto')}}">Contacto</a>
            </li>
            @guest
               <li class="nav-item"> 
                  <a class="nav-link" href="{{route('login')}}">Login</a> 
               </li>
            @else
            <li class="nav-item"> 
               <a class="nav-link {{setActive('login')}}" href="#" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">Cerrar Sesión</a>
            </li>
            @endguest

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
            </form>
         </ul>
      </div>
   </div>
 </nav>