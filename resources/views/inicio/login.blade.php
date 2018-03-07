@extends('Layout.layout2')

@section('titulo')
Inicio de sesión de usuarios
@stop

@section('estilos')
@stop

@section('contenido')
<div class="login-box">
    <div class="logo">
        <div class="row">
          <div class="col-xs-6 col-xs-offset-3">
            <img src="{{asset('/images/iconoFull.svg')}}" width="150" height="150"/>
          </div>
        </div>
        <a href="javascript:void(0);"><b>SisMin</b></a>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" method="POST" route = "{{asset('/login')}}" >
              {{csrf_field()}}
                <div class="msg">Inicio de sesión</div>
                <div class="demo-masked-input">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control email" name="correo_electronico" placeholder="Correo electrónico" required autofocus>
                    </div>
                </div>
              </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 p-t-5">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Guardar sesión</label>
                    </div>
                    <div class="col-xs-6">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">Iniciar sesión</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <a href="{{asset('/registro')}}">Registrarse</a>
                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="{{asset('/recuperar_pass')}}">¿olvidó su contraseña?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="logo">
      <small>Sistema auxiliar en la elaboración y seguimiento de las minutas de reuniones de trabajo.</small>
    </div>
</div>
@stop

@section('scripts')
<!-- Input Mask Plugin Js -->
<script src="{{asset('/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

<script>
$(function () {

  //Masked Input ============================================================================================================================
  var $demoMaskedInput = $('.demo-masked-input');
//Email
  $demoMaskedInput.find('.email').inputmask({ alias: "email" });
});
</script>
@stop
