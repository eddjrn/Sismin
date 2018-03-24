@extends('Layout.layout2')

@section('titulo')
Inicio de sesión de usuarios
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
            <img src="{{asset('/images/iconoFull.svg')}}" width="150" height="150"/>
          </div>
        </div>
        <a href="javascript:void(0);"><b>SisMin</b></a>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in">
                <div class="msg">Inicio de sesión</div>
                <div class="demo-masked-input">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control email" id="correo_electronico" name="correo_electronico" placeholder="Correo electrónico">
                    </div>
                </div>
              </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <button class="btn btn-block bg-pink waves-effect" type="button" onclick="guardar();">Iniciar sesión</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <a href="{{asset('/registro')}}">Registrarse</a>
                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="{{asset('/recuperar_pass')}}">¿Olvidó su contraseña?</a>
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

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function guardar(){
  var url = "{{asset('/login')}}";
  var urlToRedirectPage = "{{asset('/')}}";

  var correo_electronico = document.getElementById('correo_electronico').value;
  var password = document.getElementById('password').value;

  var formdata = new FormData();
  formdata.append('correo_electronico', correo_electronico);
  formdata.append('password', password);

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
     } else{
       notificacionAjax('bg-green',result.mensaje, 2500,  'bottom', 'center', null, null);
       //mensajeAjax('Registro correcto', result.mensaje,'success');
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
@stop
