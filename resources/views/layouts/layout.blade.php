<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Default Title')</title>
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-ui.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('jquery/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery/jquery-ui.theme.css') }}">
     @vite(['resources/js/app.js']) @vite(['resources/css/app.css'])


</head>

<body>


    @yield('content')




</body>

</html>
<script>
    $("#check-in,#check-out").datepicker();
</script>
