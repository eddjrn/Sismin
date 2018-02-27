@extends('Layout.layout2')

@section('title')
Recuperar contraseña
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
          <form id="forgot_password" method="POST">
              <div class="msg">
                  Ingrese su dirección de correo electrónico que utilizó para registrarse.
                  Le enviaremos un correo electrónico con su nombre de usuario y un enlace para restablecer su contraseña..
              </div>
              <div class="demo-masked-input">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control email" placeholder="Ej: ejemplo@ejemplo.com" required autofocus>
                    </div>
                </div>
            </div>
              <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Restablecer mi contraseña</button>

              <div class="row m-t-20 m-b--5 align-center">
                  <a href="{{asset('/registro')}}">Registrarse!</a>
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
