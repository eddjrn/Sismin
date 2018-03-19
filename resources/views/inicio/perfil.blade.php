@extends('Layout.layout2')

@section('titulo')
Perfil de usuario
@stop

@section('estilos')
<meta name="csrf-token" content="{{ csrf_token() }}" /> <!--cabecera para que se puedan enviar peticiones POST desde javascript-->
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
          <h2 class="card-inside-title msg">{{Auth::user()}}</h2>

          <h2 class="card-inside-title">Correo electrónico</h2>
          <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">email</i>
            </span>
            <div class="form-line disabled">
              <input type="text" class="form-control"  value="{{Auth::user()->correo_electronico}}" disabled="">
            </div>
          </div>
          <h2 class="card-inside-title">Rúbrica</h2>
          <div class="input-group">
            <img src="{{Auth::user()->rubrica}}" class="thumbnail"/>
          </div>

          <button type="button" class="btn btn-block btn-lg bg-pink waves-effect" data-toggle="modal" data-target="#cambiarCModal">Cambiar contraseña</button>
          <a href="{{asset('/')}}" class="btn btn-block btn-lg bg-pink waves-effect">Regresar</a>

        </form>
      </div>
    </div>

    <div class="logo">
      <small>Sistema auxiliar en la elaboración y seguimiento de las minutas de reuniones de trabajo.</small>
    </div>
</div>


  <div class="modal fade" id="cambiarCModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModalLabel">Cambiar contraseña</h4>
                </div>
                <div class="modal-body">
                  <form id="forgot_password" method="POST" route = "{{asset('/perfil')}}" >
                    {{csrf_field()}}
                  <div class="row">
                    <div class="col-lg-12 text-center">
                      <img src="{{asset('/images/iconoFull.svg')}}" width="150" height="150"/>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="passwordAnt" name="passwordAnt" placeholder="Ingrese su contraseña actual" ata-toggle="tooltip" data-placement="top" title="Ingrese su contraseña actual">
                        </div>
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su nueva contraseña" data-toggle="tooltip" data-placement="top" title="Mínimo seis caracteres">
                        </div>
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirmar contraseña" data-toggle="tooltip" data-placement="top" title="Debe coincidir con el campo de contraseña">
                        </div>
                      </div>
                    </div>
                  </div>
                    <input type="hidden" value="{{Auth::user()->correo_electronico}}" id="correo_electronico"/>

                  <div class="modal-footer row clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <button type="button" onclick="" class="btn bg-pink btn-block waves-effect" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <button type="button"  onclick="cambiar()" class="btn btn-block bg-pink waves-effect" data-dismiss="modal">Guardar</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
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

function cambiar(){

  var url = "{{asset('/perfil')}}";
  var urlToRedirectPage = "{{asset('/login')}}";

  var correo_electronico = document.getElementById('correo_electronico').value;
  var password = document.getElementById('password').value;
  var confirm = document.getElementById('confirm').value;
  var passwordAnt = document.getElementById('passwordAnt').value;

  var formdata = new FormData();
  formdata.append('correo_electronico', correo_electronico);
  formdata.append('password', password);
  formdata.append('confirm', confirm);
  formdata.append('passwordAnt', passwordAnt);

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
@include('Errores.ajaxMensajes')

@stop
