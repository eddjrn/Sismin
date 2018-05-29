@extends('Layout.layout2')

@section('titulo')
Registrar a un nuevo usuario
@stop

@section('estilos')
<!--cabecera para que se puedan enviar peticiones POST desde javascript-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Script para dibujar -->
<script src="{{asset('/js/atrament.min.js')}}"></script>
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
        <form id="sign_up" class="demo-masked-input">
          <div class="msg">Registrar un nuevo usuario con el correo electrónico: {{$correo}}</div>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">person</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control nombre" name="nombre" id="nombre"  onkeypress="return validar(event)" placeholder="Nombre" autocomplete="off">
            </div>
          </div>

          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">person</i>
            </span>
            <div class="form-line">
              <input type="text" class="form-control apellido_paterno" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido paterno" autocomplete="off">
            </div>
          </div>

          <div class="input-group">
              <span class="input-group-addon">
                  <i class="material-icons">person</i>
              </span>
              <div class="form-line">
                <input type="text" class="form-control apellido_materno" id="apellido_materno" name="apellido_materno" placeholder="Apellido materno" autocomplete="off">
              </div>
          </div>

          <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" data-toggle="tooltip" data-placement="top" title="Mínimo seis caracteres" autocomplete="off">
            </div>
          </div>

          <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirmar contraseña" data-toggle="tooltip" data-placement="top" title="Debe coincidir con el campo de contraseña" autocomplete="off">
            </div>
          </div>

          <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
              <button type="button" class="btn btn-block bg-pink waves-effect" data-toggle="modal" data-target="#rubricaModal">Rúbrica</button>
            </div>
            <div class="col-xs-6 col-xs-offset-3">
              <button type="button" class="btn btn-block bg-pink waves-effect" onclick="guardar();" id="btnEnviar">Registrarme</button>
            </div>
          </div>

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

<div class="modal fade" id="rubricaModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document" id="rubricaCanvas">
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
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <button type="button" id="clear" onclick="event.preventDefault(); atrament.clear();" class="btn bg-pink btn-block waves-effect">Borrar</button>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <button type="button" class="btn bg-pink btn-block waves-effect" data-dismiss="modal">Guardar</button>
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

<script>
$(function () {
  //Masked Input ============================================================================================================================
  var $demoMaskedInput = $('.demo-masked-input');
  //Nombre
  //$demoMaskedInput.find('.nombre').inputmask('aaaaaaaaaaaaaaaaaaaa',{ placeholder: ''});
  //Apellido_Paterno
  $demoMaskedInput.find('.apellido_paterno').inputmask('aaaaaaaaaaaaaaaaaaaa',{ placeholder: ''});
  //apellido_materno
  $demoMaskedInput.find('.apellido_materno').inputmask('aaaaaaaaaaaaaaaaaaaa',{ placeholder: ''});
});
function validar(e) {
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==8) return true; //Tecla de retroceso (para poder borrar)
// dejar la línea de patron que se necesite y borrar el resto
patron =/[A-Za-z\s]/;
//
te = String.fromCharCode(tecla);
return patron.test(te);
}
</script>

<!-- Script de las opciones del plugin de dibujo -->
<script>
  var canvas = document.getElementById('sketcher');
  var atrament = atrament(canvas, 240, 240);
  atrament.opacity = 0.6;

  canvas.addEventListener('dirty', function(e) {
    clearButton.style.display = atrament.dirty ? 'inline-block' : 'none';
  });
</script>

<!-- Script de envio de formularios mediante ajax -->
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function guardar(){
  var url = "{{asset('/registro')}}/{{$correo}}/{{$codigo}}";
  var urlToRedirectPage = "{{asset('/')}}";
  $('#btnEnviar').html('Cargando...');
  $('#btnEnviar').prop('disabled', true);

  var nombre = document.getElementById('nombre').value;
  var apellido_paterno = document.getElementById('apellido_paterno').value;
  var apellido_materno = document.getElementById('apellido_materno').value;
  var correo_electronico = "{{$correo}}";
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
         $('#btnEnviar').html('Registrarme');
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
       $('#btnEnviar').html('Registrarme');
       $('#btnEnviar').prop('disabled', false);
      }
    })
  });
}
</script>

@stop
