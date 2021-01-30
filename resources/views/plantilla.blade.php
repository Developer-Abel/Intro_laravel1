<html>
   <head>
      <title>@yield('title','default')</title>
   </head>
   <body>
      <nav>
         <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="{{url('portafolio')}}">Portafolio</a></li>
            <li><a href="{{url('contact')}}">Contacto</a></li>
         </ul>
      </nav>
      @yield('content')
   </body>
</html>