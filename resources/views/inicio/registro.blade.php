@extends('Layout.layout2')

@section('title')
Registrar a un nuevo usuario
@stop

@section('estilos')
<meta name="csrf-token" content="{{ csrf_token() }}" /> <!--cabecera para que se puedan enviar peticiones POST desde javascript-->
<script src="{{asset('/js/atrament.min.js')}}"></script>
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
        <form id="sign_up" class="demo-masked-input">
          <div class="msg">Registrar un nuevo usuario</div>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">person</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control nombre" name="nombre" id="nombre" placeholder="Nombre" required autofocus>
            </div>
          </div>

          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">person</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control apellido_paterno" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido paterno" required autofocus>
            </div>
          </div>

          <div class="input-group">
              <span class="input-group-addon">
                  <i class="material-icons">person</i>
              </span>
              <div class="form-line">
                <input type="text" class="form-control apellido_materno" id="apellido_materno" name="apellido_materno" placeholder="Apellido materno" required autofocus>
              </div>
          </div>

          <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">email</i>
            </span>
            <div class="form-line">
                <input type="text" class="form-control email" id="correo_electronico" name="correo_electronico" placeholder="Ej: ejemplo@ejemplo.com" required autofocus>
            </div>
          </div>

          <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input type="password" class="form-control" id="password" name="password" minlength="6" placeholder="contraseña" required>
            </div>
          </div>

          <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="fordemo-masked-inputm-line">
                <input type="password" class="form-control" id="confirm" name="confirm" minlength="6" placeholder="Confirmar contraseña" required>
            </div>
          </div>

          <button type="button" class="btn btn-block btn-lg bg-pink waves-effect" data-toggle="modal" data-target="#defaultModal">Rúbrica</button>
          <button type="button" class="btn btn-block btn-lg bg-pink waves-effect" onclick="guardar2();">Registrarme</button>

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

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document" id="rubricaCanvas">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="largeModalLabel">Dibujar rúbrica</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                    <canvas id="sketcher" class="thumbnail text-center"></canvas>
                  </div>
                </div>
                <div class="modal-footer row clearfix">
                  <div class="col-md-4 col-xs-12">
                    <button type="button" id="clear" onclick="event.preventDefault(); atrament.clear();" class="btn bg-pink btn-block waves-effect">Borrar</button>
                  </div>
                  <div class="col-md-4 col-xs-12">
                    <button type="button" class="btn bg-pink btn-block waves-effect" data-dismiss="modal">Guardar</button>
                  </div>
                  <div class="col-md-4 col-xs-12">
                    <button type="button" onclick="event.preventDefault(); atrament.clear();" class="btn bg-pink btn-block waves-effect" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>

@stop
@section('scripts')
<!-- Input Mask Plugin Js -->
<script src="{{asset('/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
<!-- SweetAlert Plugin Js -->
<script src="{{asset('/plugins/sweetalert/sweetalert.min.js')}}"></script>

<script>
$(function () {
  //Masked Input ============================================================================================================================
  var $demoMaskedInput = $('.demo-masked-input');
  //Nombre
  $demoMaskedInput.find('.nombre').inputmask('aaaaaaaaaaaaaaaaaaaa',{ placeholder: '' });
  //Apellido_Paterno
  $demoMaskedInput.find('.apellido_paterno').inputmask('aaaaaaaaaaaaaaaaaaaa',{ placeholder: '' });
  //apellido_materno
  $demoMaskedInput.find('.apellido_materno').inputmask('aaaaaaaaaaaaaaaaaaaa',{ placeholder: '' });
  //Email
  $demoMaskedInput.find('.email').inputmask({ alias: "email" });
});
</script>

<script>
  var canvas = document.getElementById('sketcher');
  var alto = document.getElementById('rubricaCanvas').clientHeight;
  var ancho = document.getElementById('rubricaCanvas').clientWidth;

  ancho = document.getElementById('rubricaCanvas').getBoundingClientRect();
  ancho = ancho.right - ancho.left;

  var atrament = atrament(canvas, 240, 240);
  atrament.opacity = 0.6;

  canvas.addEventListener('dirty', function(e) {
    clearButton.style.display = atrament.dirty ? 'inline-block' : 'none';
  });
</script>

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
 if(result.errors){
         mensajeAjax('Error', result.errors,'error');
       }
function guardar() {
  var url = "/registro";
  var urlToRedirectPage = "/";

  var nombre = document.getElementById('nombre').value;
  var apellido_paterno = document.getElementById('apellido_paterno').value;
  var apellido_materno = document.getElementById('apellido_materno').value;
  var correo_electronico = document.getElementById('correo_electronico').value;
  var password = document.getElementById('password').value;
  var confirm = document.getElementById('confirm').value;

  var firma = document.getElementById('sketcher').toBlob(
    function(blob) {
      console.log('Este es el blob: ', blob);
    },
    'image/jpeg', 0.8);
  var formdata = new FormData();
  formdata.append('firma', firma);
  // formdata.append('nombre', nombre);
  // formdata.append('apellido_paterno', apellido_paterno);
  // formdata.append('apellido_materno', apellido_materno);
  // formdata.append('correo_electronico', correo_electronico);
  // formdata.append('password', password);
  // formdata.append('confirm', confirm);

  var parametros = {
    nombre,
    apellido_paterno,
    apellido_materno,
    correo_electronico,
    password,
    confirm,
  };

  $.ajax(url, {
    method: "POST",
    data: parametros,
    success: function (response) {
      if(response.errors){
        mensajeAjax('Error', 'Verifique sus datos', 'error');
        var errores = '<ul>';
        $.each(response.errors,function(indice,valor){
          //console.log(indice + ' - ' + valor);
          errores += '<li>' + valor + '</li>';
        });
        errores += '</ul>';
        notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
      } else{
        mensajeAjax('Correcto', response.message, 'success');
        window.setTimeout(function(){
          location.href = urlToRedirectPage;
        } ,1500);
      }
    },
    error: function (jqXHR, status, error) {
      mensajeAjax('Error', error, 'error');
    }
  });
}


function guardar2(){
  var nombre = document.getElementById('nombre').value;
  var apellido_paterno = document.getElementById('apellido_paterno').value;
  var apellido_materno = document.getElementById('apellido_materno').value;
  var correo_electronico = document.getElementById('correo_electronico').value;
  var password = document.getElementById('password').value;
  var confirm = document.getElementById('confirm').value;

  document.getElementById('sketcher').toBlob(function(blob){
    var formdata = new FormData();

    formdata.append('imagen',blob);
    formdata.append('nombre', nombre);
    formdata.append('apellido_paterno', apellido_paterno);
   formdata.append('apellido_materno', apellido_materno);
   formdata.append('correo_electronico', correo_electronico);
   formdata.append('password', password);
   formdata.append('confirm', confirm);

   $.ajax({
     type:'POST',
     url:'/registro',
     data:formdata,
     processData:false,
     contentType:false,
     success:function(result){
       if(result.errors){
         mensajeAjax('Error', 'Verifique sus datos', 'error');
         var errores = '<ul>';
         $.each(result.errors,function(indice,valor){
           //console.log(indice + ' - ' + valor);
           errores += '<li>' + valor + '</li>';
         });
         errores += '</ul>';
         notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
       } else{
       mensajeAjax('Registro correcto', result.mensaje,'success');
     }

     },
     error: function (jqXHR, status, error) {
       mensajeAjax('Error', error, 'error');
     }
   })
  }, "image/jpeg", 0.95);

}
</script>

@include('Errores.ajaxMensajes')

@stop
