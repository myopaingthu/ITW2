<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | ITW2</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini" style="font-size: 12px;">
    <div class="wrapper" id="app">
        @include('layouts.nav')
        @include('layouts.aside')
        <div class="content-wrapper py-1">
            @yield('content')
        </div>
        @include('layouts.footer')
    </div>
    @if (session()->has('success'))
    <script type="module">
        $(document).ready(function() {
            toastr.success('{{session('success')}}')
        });
    </script>
    @endif

    @if (session()->has('error'))
    <script type="module">
        $(document).ready(function() {
            toastr.error('{{session('error')}}')
        });
    </script>
    @endif

    @if (session()->has('swalSuccess'))
    <script type="module">
        Swal.fire({
            text: "{{session('swalSuccess')}}",
            icon: "success",
            iconColor: "#6868AC",
            confirmButtonColor: "#6868AC",
        });
    </script>
    @endif
    @livewireScripts
</body>

</html>