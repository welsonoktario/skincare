@php
  $auth = ['login', 'register'];
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>
    @yield('title', config('app.name', 'Laravel'))
  </title>
  <link rel="stylesheet" href="https://api.fontshare.com/v2/css?f[]=switzer@2,1&display=swap">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  @stack('styles')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">

      @if (
          !in_array(request()->route()->getName(),
              $auth))
        @include('user.navbar')
      @endif
      <div class="container mx-auto" style="padding-top: 6.5%;">
        @yield('content')
      </div>
    </div>
  </div>

  @include('sweetalert::alert')
  @routes
  <script src="{{ asset('js/manifest.js') }}"></script>
  <script src="{{ asset('js/vendor.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>

</html>
