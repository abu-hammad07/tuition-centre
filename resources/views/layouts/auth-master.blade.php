<!DOCTYPE html>
<html lang="en">

<head>
    <!--  Title -->
    <title>@yield('title')</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="T-center" />
    <meta name="author" content="" />
    <meta name="keywords" content="T-center" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('dist/images/favicon.png') }}" />
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ URL::asset('dist/css/style.min.css') }}" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ URL::asset('dist/images/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ URL::asset('dist/images/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @yield('content')

    </div>

    <!--  Import Js Files -->
    <script src="{{ URL::asset('dist/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!--  core files -->
    <script src="{{ URL::asset('dist/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('dist/js/app.init.js') }}"></script>
    <script src="{{ URL::asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ URL::asset('dist/js/sidebarmenu.js') }}"></script>

    <script src="{{ URL::asset('dist/js/custom.js') }}"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('voice_message'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                playVoiceMessage("{{ session('voice_message') }}");
            });

            function playVoiceMessage(message) {
                const speech = new SpeechSynthesisUtterance(message);
                speech.lang = "en-US"; // Urdu language
                speech.rate = 1; // Speed of voice
                speech.pitch = 1; // Pitch of voice
                window.speechSynthesis.speak(speech);
            }
        </script>
    @endif

    @yield('scripts')

</body>

</html>
