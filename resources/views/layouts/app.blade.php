<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  </head>
  <body>
    <div class="container-scroller">
      
        @guest
            @yield('content')

        @else
            @include('layouts.navbar')

            <div class="container-fluid page-body-wrapper">
                @include('layouts.sidebar')
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
        @endguest
      </div>

    <!-- Scripts -->
    <script src="{{ asset('js/all.js') }}"></script>

    @yield('modals')

    @stack('script')
    
  </body>
</html>