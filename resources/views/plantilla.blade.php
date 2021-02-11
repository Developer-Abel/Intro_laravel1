<html>
   <head>
      <title>@yield('title','default')</title>
      <style>
         .active a{
            color: red;
            text-decoration:none;
         }
      </style>
   </head>
   <body>
      @include('partials.nav')

      @include('partials.session-message')

      @yield('content')
   </body>
</html>