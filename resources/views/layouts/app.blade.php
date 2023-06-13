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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
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

  @routes
  <script src="{{ asset('js/manifest.js') }}"></script>
  <script src="{{ asset('js/vendor.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="SB-Mid-client-h7gacNDsOHUce4L3"></script>
  @stack('scripts')
</body>

</html>
