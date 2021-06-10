<!DOCTYPE html>

<html lang="{{ config('app.locale') }}" >
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0" />
    <title>{{ isset($meta_title) ? $meta_title : config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

     <!-- favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="shortcut icon" href="{{ asset('img/favicons/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="Make Systems">
    <meta name="application-name" content="Make Systems">
    <meta name="msapplication-TitleColor" content="#000">
    <meta name="theme-color" content="#0059fe">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="base-url" content="{{ url('/') }}" />

    @yield('metas')
    <style type="text/css">
       [v-cloak] {
          display: none;
      } 

    </style>
    <script>
        window.paceOptions = {
            restartOnRequestAfter: false
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnify/2.3.3/css/magnify.min.css" integrity="sha512-wzhF4/lKJ2Nc8mKHNzoFP4JZsnTcBOUUBT+lWPcs07mz6lK3NpMH1NKCKDMarjaw8gcYnSBNjjllN4kVbKedbw==" crossorigin="anonymous" />
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />    
    <link type="text/css" rel="stylesheet" href="{{ asset('css/my_styles.css') }}" />    

    @stack('css')

    <link href="//fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  </head>

  <body id="body">
    <div class="loader" style="display: none"></div>
    <div id="app">
      @include('_partials.header')
        @yield('content')
      @include('_partials.footer') <!-- FOOTER --> 
    </div>
    
    <script>
        var baseRoot = "{{ url('/')}}";
        var hereUrl = '{{ request()->url() }}';
        var title_envio_newsletter = "{{ __('messages.send_newsletter') }}";
        var title_registered_mail = "{{ __('messages.registered_mail') }}";
        var title_send_contact = "{{ __('messages.send_email') }}";
        var title_error = "{{ __('messages.error_send_email') }}";
        var title_invalid_recaptcha = "{{ __('messages.invalid_recaptcha') }}";
        var email_invalid = "{{ __('messages.email_invalid') }}";
        var required_email = "{{ __('messages.required_email') }}";
        var whatsapp = "{{ config('settings.whatsapp') }}";
        var message_whatsapp = "{{ config('settings.message_whatsapp') }}";
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
  
  

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ asset('js/my_scripts.js') }}"></script> --}}
    @if (session()->has('error_login'))  
      <script type="text/javascript">
         var errors = '{{ session()->get('error_login') }}'
            swal({
                  title: errors,
                  type: "error",
                  confirmButtonText: "Cerrar",
                  confirmButtonColor: '#fb704b'

         });         
      </script>
        @php
            session()->forget('error_login')
       @endphp
    @endif

    @stack('js')
  </body>

</html>

