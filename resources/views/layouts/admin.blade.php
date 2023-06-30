<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
  @stack('styles')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      @include('admin.navbar')
      @include('admin.sidebar')
      <div class="main-content" id="main-content">
        @yield('content')
      </div>
    </div>
  </div>

  @include('sweetalert::alert')
  @routes()
  <script src="{{ asset('js/manifest.js') }}"></script>
  <script src="{{ asset('js/vendor.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://unpkg.com/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <script src="https://unpkg.com/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
  @stack('scripts')
</body>

</html>
