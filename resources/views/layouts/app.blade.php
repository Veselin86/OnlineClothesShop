<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <script src="{{ asset('js/loadProducts.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
