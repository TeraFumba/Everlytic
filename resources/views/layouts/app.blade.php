<html>

<head>
    <title>List Manager </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body >
<header class="main-header" role="banner">
    <img style="width: 100%; height: 300px;   overflow: hidden;"  src="{{url('banner.PNG')}}" width="100" height="100" >
</header>
<div class="container " style="padding:10px;padding-bottom:60px;">
    @yield('content')
</div>

</body>
<!-- Copyright -->
<div class="fixed-bottom">
    <footer class="text-center p-4 " style="background-color: #343a40;color: white;font-size: 11px;  width: 100%;">
        © Copyright User List App
    </footer>
</div>
<!-- Copyright -->

</html>
