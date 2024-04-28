<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('css')

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
</head>

<body id="page-top">
<div class="container">

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="text-center">Copyright &copy; {{ date('Y') }}</p>
        </div>
    </footer>

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>

<!-- JavaScript -->
<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
<script src="{{ asset('js/jquery-slim.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

@yield('js')

</body>

</html>
