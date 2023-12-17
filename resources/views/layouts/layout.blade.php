<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Default Title')</title>
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-ui.js') }}"></script>
    <link rel="icon" href="../img/LP4Y_Logo.webp" type="image/webp">
    <link rel="stylesheet" href="{{ asset('jquery/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery/jquery-ui.theme.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>

    <!-- Include Hammer.js library for swipe detection -->
<script src="https://hammerjs.github.io/dist/hammer.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script> --}}
    @vite(['resources/js/app.js']) @vite(['resources/css/app.css'])


</head>

<body>


    @yield('content')



</body>

</html>
<script></script>
