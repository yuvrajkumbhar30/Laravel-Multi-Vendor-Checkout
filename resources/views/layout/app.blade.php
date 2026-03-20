<!DOCTYPE html>
<html>
<head>
    <title>Multi Vendor Store</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .footer {
            background: #222;
            color: #fff;
            padding: 20px 0;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    @include('layout.header')

    <!-- MAIN CONTENT -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- FOOTER -->
    @include('layout.footer')

</body>
</html>