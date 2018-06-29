<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Exp') - Laravel</title>
    <link rel="stylesheet" href="/css/app.css">
    <meta name="_token" content="{{ csrf_token() }}">
</head>
<body>
@include('layouts._header')


<div class="container">
    <div class="col-md-offset-1 col-md-10">
        @include('shared._messages')
        @yield('content')
        @include('layouts._footer')
    </div>
</div>

<script src="/js/app.js"></script>
<script src="/js/jquery.min.js"></script>

</body>
</html>