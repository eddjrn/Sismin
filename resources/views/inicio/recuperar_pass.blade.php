@extends('Layout.layout2')

@section('titulo')
Recuperar contraseña
@stop

@section('estilos')
@stop

@section('contenido')
<div class="login-box">
    <div class="logo">
        <div class="row">
          <div class="col-xs-6 col-xs-offset-3">
            <img src="{{asset('/images/olvidar_perfil.svg')}}" width="150" height="150"/>
          </div>
        </div>
        <a href="javascript:void(0);"><b>SisMin</b></a>
    </div>
    <div class="card">
      <div class="body">
            <form id="forgot_password" method="POST" route = "{{asset('/recuperar_pass')}}" >
              {{csrf_field()}}
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
                        <input type="text" class="form-control email" name="correo_electronico" id="correo_electronico" placeholder="Correo electrónico">
                    </div>
                </div>
            </div>
              <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <button class="btn btn-block bg-pink waves-effect" type="submit" id="btnEnviar">Envíar</button>
                </div>
              </div>
              <div class="row m-t-15 m-b--20">
                  <div class="col-xs-6">
                      <a href="{{asset('/solicitud_registro')}}">Registrarse</a>
                  </div>
                  <div class="col-xs-6 align-right">
                      <a href="{{asset('/login')}}">¿Ya estás registrado?</a>
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

  $("#btnEnviar").click(function(event){
      var registro = $('#correo_electronico').val();
      if(registro != ""){
        $('#btnEnviar').html('Cargando...');
        $('#btnEnviar').prop('disabled', true);
      } else{
        $('#btnEnviar').html('Envíar');
        $('#btnEnviar').prop('disabled', false);
        notificacionAjax('bg-red', 'El campo de correo electrónico no puede esta vacío', 2500,  'bottom', 'center', null, null);
        event.preventDefault();
      }
  });
});
</script>
@stop
