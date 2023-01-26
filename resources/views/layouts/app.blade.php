<!doctype html>
<html lang="lt">

  <head>
    @include('layouts.head')
  </head>

  <body class="antialiased">

    @yield('content')

    {{-- Webpack --}}
    <script type="text/javascript" src="{{ mix('js/main.js') }}"></script>





  </body>
