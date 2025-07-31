<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'App PBG' }}</title>
        <link href="{{asset('images/favicon.ico')}}" rel="icon">
        <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
      
        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com" rel="preconnect"> --}}
        {{-- <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin> --}}
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      
        <!-- Vendor CSS Files -->
        <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.cs')}}s" rel="stylesheet">
        <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
        <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
        <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
                <!-- Main CSS File -->
        <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">

        @livewireStyles
        @stack('styles')
    </head>
    <body class="index-page">
        @include('components.layouts.header')

        <main class="main">
        {{ $slot }}
        </main>
      
        @include('components.layouts.footer')

        
          <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up-short"></i>
        </a>

          
        
        <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
        <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
        <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
        <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
        <script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>

        <!-- Main JS File -->
        <script src="{{asset('assets/js/main.js')}}"></script>
        <script src="{{asset('assets/js/jquery360.min.js')}}"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{asset('assets/js/toastr.min.js')}}"></script>
        <script>
            window.addEventListener('alert', event => {
                toastr[event.detail.type](event.detail.message,
                    event.detail.title ?? ''), toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                }
            });
        </script>
        @livewireScripts
        <script src="{{asset('assets/js/sweartalert.js')}}"></script>
  
        <x-livewire-alert::scripts />
        @stack('scripts')
    </body>
</html>
