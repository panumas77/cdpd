<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Bootstrap 5.3.0-->
    {{-- <link href="{{ asset('vendor/twbs/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Font Awesome 6.4.0-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- flatpickr4 module Datepicker-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Pickadate 3.6.2 -->
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('storage/assets/pickadate/lib/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/pickadate/lib/themes/default.date.css') }}">


</head>

<body>
    @auth
        {{-- Nav section --}}
        @include('layout.nav')
        {{-- Nav section --}}
    @endauth
    <div class="container pt-3">
        {{-- Success message section --}}
        @include('shared.success-message')
        {{-- Success message section --}}
        {{-- Content section --}}
        @yield('content')
        {{-- Content section --}}

    </div>
    <!-- JQuery 3.7.0-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


    <!-- Pickadate 3.6.2 -->
    <script src="{{ asset('storage/assets/pickadate/lib/picker.js') }}"></script>
    <script src="{{ asset('storage/assets/pickadate/lib/picker.date.js') }}"></script>

    <!-- SweetAlert2 v.11 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JQuery Thai Address autocomplete 1.5.3.5 -->
    <!-- Dependencies -->
    <script type="text/javascript"
        src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript"
        src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>

    <link rel="stylesheet"
        href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <script type="text/javascript"
        src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!--END JQuery Thai Address autocomplete 1.5.3.5 -->
</body>

</html>
{{-- script section --}}
@yield('script')
{{-- script section --}}
<script>
    // Auto-hide success alert after 3 seconds
    setTimeout(function() {
        $("#status-alert").alert('close');
    }, 3000);
</script>
