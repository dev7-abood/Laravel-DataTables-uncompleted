<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{'plugins/datatables/datatables.net-dt/css/jquery.dataTables.min.css'}}">
    <title>Document</title>
</head>
<body>

<div class="container">

    @yield('content')

    @yield('table')

</div>

<script src="{{'js/app.js'}}"></script>
<script src="{{'plugins/bootstrap/dist/js/bootstrap.min.js'}}"></script>
<script src="{{'plugins/datatables/datatables.net/js/jquery.dataTables.min.js'}}"></script>
@yield('script')
@yield('table_script')
</body>
