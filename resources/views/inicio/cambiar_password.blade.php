@extends('Layout.layout2')

@section('titulo')
Cambiar contraseña
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
            <img src="{{asset('/images/cambiar_perfil.svg')}}" width="150" height="150"/>
          </div>
        </div>
        <a href="javascript:void(0);"><b>SisMin</b></a>
    </div>
    <div class="card">
      <div class="body">
            <form id="forgot_password" method="POST" route = "{{asset('/cambiar_password')}}" >
              {{csrf_field()}}
              <div class="msg">
                  Ingrese su nueva contraseña.
                  <input type="hidden" value="{{$correo}}" id="correo_electronico"/>
              </div>
              <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="form-line">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" data-toggle="tooltip" data-placement="top" title="Mínimo seis caracteres">
                </div>
              </div>

              <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="fordemo-masked-inputm-line">
                    <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirmar contraseña" data-toggle="tooltip" data-placement="top" title="Debe coincidir con el campo de contraseña">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                  <button class="btn btn-block bg-pink waves-effect" type="button" onclick="guardar()" id="btnEnviar">Restablecer mi contraseña</button>
                </div>
              </div>

              <div class="row m-t-20 m-b--5 align-center">
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
<!-- Script de envio de formularios mediante ajax -->
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function guardar(){
  var url = "{{asset('/cambiar_password')}}";
  var urlToRedirectPage = "{{asset('/')}}";
  $('#btnEnviar').html('Cargando...');
  $('#btnEnviar').prop('disabled', true);

  var correo_electronico = document.getElementById('correo_electronico').value;
  var password = document.getElementById('password').value;
  var confirm = document.getElementById('confirm').value;

  var formdata = new FormData();
  formdata.append('correo_electronico', correo_electronico);
  formdata.append('password', password);
  formdata.append('confirm', confirm);

  $.ajax({
   type:'POST',
   url: url,
   data:formdata,
   processData:false,
   contentType:false,
   success:function(result){
     if(result.errores){
       mensajeAjax('Error', 'Verifique sus datos', 'error');
       var errores = '<ul>';
       $.each(result.errores,function(indice,valor){
         //console.log(indice + ' - ' + valor);
         errores += '<li>' + valor + '</li>';
       });
       errores += '</ul>';
       notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
       $('#btnEnviar').html('Restablecer mi contraseña');
       $('#btnEnviar').prop('disabled', false);
     } else{
       mensajeAjax('Registro correcto', result.mensaje,'success');
       window.setTimeout(function(){
         location.href = urlToRedirectPage;
       } ,1500);
     }
    },
    error: function (jqXHR, status, error) {
     mensajeAjax('Error', error, 'error');
     $('#btnEnviar').html('Restablecer mi contraseña');
     $('#btnEnviar').prop('disabled', false);
    }
  })
}
</script>

@stop
