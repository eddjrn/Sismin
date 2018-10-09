<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>
      @yield('titulo')
    </title>

    @include('Layout.layoutConfigIconos')

    <!-- Google Fonts -->
    <link href="{{asset('/fonts/Roboto/fonts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/fonts/material-design-icons/iconfont/material-icons.css')}}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

    @yield('estilos')
</head>

<body class="login-page scroll">
  <!-- Page Loader -->
  <div class="page-loader-wrapper">
      <div class="loader">
          <img src="{{asset('/images/iconoFull.svg')}}" width="150" height="150"/>
          <p>Cargando...</p>
      </div>
  </div>
  <!-- #END# Page Loader -->

  @yield('contenido')

  <!-- Jquery Core Js -->
  <script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>

  <!-- Bootstrap Core Js -->
  <script src="{{asset('/plugins/bootstrap/js/bootstrap.js')}}"></script>

  <!-- Slimscroll Plugin Js -->
  <script src="{{asset('/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

  <!-- Waves Effect Plugin Js -->
  <script src="{{asset('/plugins/node-waves/waves.js')}}"></script>

  <!-- Validation Plugin Js -->
  <script src="{{asset('/plugins/jquery-validation/jquery.validate.js')}}"></script>

  <script src="{{asset('/js/pages/ui/tooltips-popovers.js')}}"></script>

  <!-- SweetAlert Plugin Js -->
  <script src="{{asset('/plugins/sweetalert/sweetalert.min.js')}}"></script>

  <!-- Bootstrap Notify Plugin Js -->
  <script src="{{asset('/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>

  @if(isset($mensaje))
    <?php $c = 0; ?>
    @foreach($mensaje as $msg)
      <?php $estiloColor = $color[$c]; ?>
      @include('Errores.mensajes')
      <?php $c++; ?>
    @endforeach
  @endif

  @if($errors->any())
    @foreach($errors->all() as $msg)
      <?php $estiloColor = "bg-red"; $tiempo = 5000;?>
      @include('Errores.mensajes')
    @endforeach
  @endif

  @include('Errores.ajaxMensajes')

  @yield('scripts')

  <!-- Custom Js -->
  <script src="{{asset('/js/admin.js')}}"></script>

  <script>
    $(function(){
        $('.bar').slimScroll({
          railVisible: false,
          alwaysVisible: true,
          allowPageScroll: true,
          size: '6px'
        });
        $('[data-toggle="popover"]').popover();
        $(':not(#anything)').on('click', function (e) { $('[data-toggle="popover"]').each(function () { if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) { $(this).popover('hide'); } }); });
    });
  </script>

</body>

</html>
