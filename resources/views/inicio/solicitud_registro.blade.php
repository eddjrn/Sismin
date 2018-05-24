@extends('Layout.layout2')

@section('titulo')
Solicitud de registro
@stop

@section('estilos')
<!--cabecera para que se puedan enviar peticiones POST desde javascript-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('contenido')
<div class="login-box">
    <div class="logo">
        <div class="row">
          <div class="col-xs-6 col-xs-offset-3">
            <img src="{{asset('/images/nuevo_perfil.svg')}}" width="150" height="150"/>
          </div>
        </div>
        <a href="javascript:void(0);"><b>SisMin</b></a>
    </div>
    <div class="card">
      <div class="body">
            <form>
              <div class="msg">
                  Ingrese su dirección de correo electrónico para solicitar su registro en SisMin.
                  Le enviaremos un correo electrónico para que pueda registrarse en el sistema..
              </div>
              <div class="demo-masked-input">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control email" name="correo_electronico" id="correo_electronico" placeholder="Correo electrónico" autocomplete="off">
                    </div>
                </div>
            </div>
              <button class="btn btn-block btn-lg bg-pink waves-effect" type="button" onClick="enviar();" id="btnEnviar">Enviar</button>
              <div class="m-t-25 m-b--5 align-center">
                <a href="{{asset('/login')}}">¿Ya estás registrado?</a>
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

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function enviar(){
  var url = "{{asset('/solicitud_registro')}}";
  var urlToRedirectPage = "{{asset('/login')}}";
  $('#correo_electronico').prop('disabled', true);
  $('#btnEnviar').hide(200);

  var correo_electronico = document.getElementById('correo_electronico').value;

  var formdata = new FormData();
  formdata.append('correo_electronico', correo_electronico);

  $.ajax({
   type:'POST',
   url: url,
   data:formdata,
   processData:false,
   contentType:false,
   success:function(result){
     if(result.errores){
      // mensajeAjax('Error', 'Verifique sus datos', 'error');
       var errores = '<ul>';
       $.each(result.errores,function(indice,valor){
         //console.log(indice + ' - ' + valor);
         errores += '<li>' + valor + '</li>';
       });
       errores += '</ul>';
       notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
       $('#correo_electronico').prop('disabled', false);
       $('#correo_electronico').val('');
       $('#btnEnviar').show(200);
     } else{
       notificacionAjax('bg-green',result.mensaje, 2500,  'bottom', 'center', null, null);
       window.setTimeout(function(){
         location.href = urlToRedirectPage;
       } ,1500);
     }
    },
    error: function (jqXHR, status, error) {
     mensajeAjax('Error', error, 'error');
     $('#correo_electronico').prop('disabled', false);
     $('#correo_electronico').val('');
     $('#btnEnviar').show(200);
    }
  });
}
</script>
@stop
