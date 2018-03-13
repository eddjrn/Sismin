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

    @yield('estilos')

</head>

<body class="theme-pink ls-closed" >
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <!-- <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div> -->
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
                      <a href="javascript:void(0);" class="dropdown-toggle" role="button" data-toggle="tooltip" data-placement="bottom" title="Inicio">
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


                    <!-- Notifications -->
                    <!-- <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <!-- <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- #END# Tasks -->

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
                      <li data-theme="red">
                          <i class="material-icons">add</i>
                          <span>Nueva reunión</span>
                      </li>
                      <li data-theme="red">
                          <i class="material-icons">note_add</i>
                          <span>Nueva minuta</span>
                      </li>
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

  <!-- Select Plugin Js -->
  <script src="{{asset('/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

  <!-- Slimscroll Plugin Js -->
  <script src="{{asset('/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

  <!-- Bootstrap Notify Plugin Js -->
  <script src="{{asset('/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>

  <!-- Waves Effect Plugin Js -->
  <script src="{{asset('/plugins/node-waves/waves.js')}}"></script>

  <!-- Jquery CountTo Plugin Js -->
  <script src="{{asset('/plugins/jquery-countto/jquery.countTo.js')}}"></script>

  @if(isset($mensaje))
    <?php $c = 0; ?>
    @foreach($mensaje as $msg)
      <?php $estiloColor = $color[$c]; ?>
      @include('Errores.mensajes')
      <?php $c++; ?>
    @endforeach
  @endif

  <!-- Custom Js -->
  <script src="{{asset('/js/admin.js')}}"></script>
  <script src="{{asset('/js/pages/ui/tooltips-popovers.js')}}"></script>
  <script src="{{asset('/js/pages/index.js')}}"></script>

  <!-- Demo Js -->
  <script src="{{asset('/js/demo.js')}}"></script>

  @yield('scripts')

</body>

</html>
