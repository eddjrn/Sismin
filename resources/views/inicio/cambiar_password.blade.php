@extends('Layout.layout2')

@section('titulo')
Cambiar contraseña
@stop

@section('estilos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{asset('/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

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
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                </div>
              </div>

              <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="fordemo-masked-inputm-line">
                    <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirmar contraseña">
                </div>
              </div>
              <button class="btn btn-block btn-lg bg-pink waves-effect" type="button" onclick="guardar()">Restablecer mi contraseña</button>

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
<script src="{{asset('/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function guardar(){
  var url = "{{asset('/cambiar_password')}}";
  var urlToRedirectPage = "{{asset('/')}}";

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
     } else{
       mensajeAjax('Registro correcto', result.mensaje,'success');
       window.setTimeout(function(){
         location.href = urlToRedirectPage;
       } ,1500);
     }
    },
    error: function (jqXHR, status, error) {
     mensajeAjax('Error', error, 'error');
    }
  })
}
</script>

@include('Errores.ajaxMensajes')

@stop
