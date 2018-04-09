<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>
      @yield('titulo')
    </title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('/images/iconoMin.svg')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('/css/themes/all-themes.css')}}" rel="stylesheet" />

    <link href="{{asset('/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

    @yield('estilos')
</head>

<body class="theme-pink ls-closed" >
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <img src="{{asset('/images/iconoFull.svg')}}" width="150" height="150"/>
            <p>Cargando...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a class="navbar-brand" href="{{asset('/')}}"><b>SisMin</b></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                      <a href="{{asset('/')}}" class="dropdown-toggle" role="button" data-toggle="tooltip" data-placement="bottom" title="Inicio">
                          <i class="material-icons">dashboard</i>
                          <span class="label-count">7</span>
                      </a>
                  </li>
                  <li class="dropdown">
                      <a href="javascript:void(0);" class="dropdown-toggle" role="button" data-toggle="tooltip" data-placement="bottom" title="Archivos">
                          <i class="material-icons">archive</i>
                          <span class="label-count">7</span>
                      </a>
                  </li>
                  <li class="dropdown">
                      <a href="javascript:void(0);" class="dropdown-toggle" role="button" data-toggle="tooltip" data-placement="bottom" title="Agenda">
                          <i class="material-icons">insert_invitation</i>
                          <span class="label-count">7</span>
                      </a>
                  </li>
                  <li class="pull-right">
                    <a href="javascript:void(0);" class="js-right-sidebar" data-close="true" data-toggle="tooltip" data-placement="bottom" title="Menú">
                      <i class="material-icons">chrome_reader_mode</i>
                    </a>
                  </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->

    <section>
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">Usuario</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">Sistema</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <p>{{Auth::user()}}</p>
                    <ul class="demo-choose-skin">
                      <!-- <li data-theme="red" class="active"> -->
                        <a href="{{asset('/perfil')}}">
                          <li data-theme="red">
                              <i class="material-icons">face</i>
                              <span>Perfil</span>
                          </li>
                        </a>
                        <a href="{{asset('/logout')}}">
                          <li data-theme="red">
                              <i class="material-icons">highlight_off</i>
                              <span>Cerrar sesión</span>
                          </li>
                        </a>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                  <ul class="demo-choose-skin">
                    <!-- <li data-theme="red" class="active"> -->
                    <a href="{{asset('/reunion')}}">
                      <li data-theme="red">
                          <i class="material-icons">add</i>
                          <span>Nueva reunión</span>
                      </li>
                    </a>
                   <a href="{{asset('/Motivo')}}">
                      <li data-theme="red">
                          <i class="material-icons">note_add</i>
                          <span>Dar de alta un nuevo tipo de reunión</span>
                      </li>
                    </a>
                    <a href="{{asset('/rolUsuario')}}">
                       <li data-theme="red">
                           <i class="material-icons">assistant</i>
                           <span>Dar de alta un rol de usuario</span>
                       </li>
                     </a>
                      <a href="{{asset('/acercade')}}">
                        <li data-theme="red">
                          <i class="material-icons">help</i>
                          <span>Acerca de...</span>
                        </li>
                      </a>
                      <p><img src="{{asset('/images/iconoFull.svg')}}" width="150" height="150"/></p>
                  </ul>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
</section>

<section class="content">
    <div class="container-fluid">
      <div class="block-header">
          <h2>@yield('cabecera')</h2>
      </div>
      @yield('contenido')
    </div>
</section>

  <!-- Jquery Core Js -->
  <script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>

  <!-- Bootstrap Core Js -->
  <script src="{{asset('/plugins/bootstrap/js/bootstrap.js')}}"></script>

  <!-- Slimscroll Plugin Js -->
  <script src="{{asset('/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

  <!-- Waves Effect Plugin Js -->
  <script src="{{asset('/plugins/node-waves/waves.js')}}"></script>

  <script src="{{asset('/js/pages/ui/tooltips-popovers.js')}}"></script>

  <!-- Bootstrap Notify Plugin Js -->
  <script src="{{asset('/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>

  <!-- SweetAlert Plugin Js -->
  <script src="{{asset('/plugins/sweetalert/sweetalert.min.js')}}"></script>

  @if(isset($mensaje))
    <?php $c = 0; ?>
    @foreach($mensaje as $msg)
      <?php $estiloColor = $color[$c]; ?>
      @include('Errores.mensajes')
      <?php $c++; ?>
    @endforeach
  @endif

  @include('Errores.ajaxMensajes')

  @yield('scripts')

  <!-- Jquery CountTo Plugin Js -->
  <script src="{{asset('/plugins/jquery-countto/jquery.countTo.js')}}"></script>

  <!-- Custom Js -->
  <script src="{{asset('/js/admin.js')}}"></script>

  <script>
    $(function(){
        $('.bar').slimScroll({
          height: '300px',
          railVisible: true,
          alwaysVisible: true,
          allowPageScroll: true,
          size: '8px'
        });
    });
  </script>

  <script src="{{asset('/js/pages/index.js')}}"></script>

  <!-- Demo Js -->
  <script src="{{asset('/js/demo.js')}}"></script>

</body>

</html>
