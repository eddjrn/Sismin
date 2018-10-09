
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('titulo')</title>

    @include('Layout.layoutConfigIconos')

    <!-- Google Fonts -->
    <link href="{{asset('/fonts/Roboto/fonts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/fonts/material-design-icons/iconfont/material-icons.css')}}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
</head>

<body class="four-zero-four">
    <img src="{{asset('/images/iconoFull.svg')}}" width="150" height="150"/>
    <div class="four-zero-four-container">
        <div class="error-code">@yield('codigo')</div>
        <div class="error-message">@yield('mensaje')</div>
        <div class="button-place">
            <a href="{{asset('/')}}" class="btn btn-default btn-lg waves-effect">Ir a inicio</a>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('/plugins/node-waves/waves.js')}}"></script>
</body>

</html>
