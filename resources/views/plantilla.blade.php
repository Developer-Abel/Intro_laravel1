<html>
   <head>
      <title>@yield('title','default')</title>
      <link rel="stylesheet" href="{{mix('css/app.css')}}">
      <script src="{{mix('js/app.js')}}" defer></script>
   </head>
   <body>
      @include('partials.nav')

      @include('partials.session-message')

      @yield('content')
      <script src="{{asset('js/app.js')}}"></script>
   </body>
</html>