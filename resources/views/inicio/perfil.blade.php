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

          <button type="button" class="btn btn-block btn-lg bg-pink waves-effect" data-toggle="modal" data-target="#confirmModal">Eliminar cuenta</button>
          <a href="{{asset('/')}}" class="btn btn-block btn-lg bg-pink waves-effect">Regresar</a>

        </form>
      </div>
    </div>

    <div class="logo">
      <small>Sistema auxiliar en la elaboración y seguimiento de las minutas de reuniones de trabajo.</small>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="largeModalLabel">Eliminar cuenta</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12 text-center">
                    <img src="{{asset('/images/iconoFull.svg')}}" width="150" height="150"/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <p class="font-bold">¿Seguro que desea eliminar su cuenta de manera permanente?</p>
                    <p class="font-italic col-pink">- Tendrá que crear una cuenta nueva para ingresar a el sistema...</p>
                  </div>
                </div>
                <div class="modal-footer row clearfix">
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <button type="button" id="clear" onclick="" class="btn btn-danger btn-block waves-effect" data-toggle="modal" data-target="#borrarModal" data-dismiss="modal">Borrar</button>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <button type="button" onclick="" class="btn bg-pink btn-block waves-effect" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="borrarModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModalLabel">Eliminar cuenta</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-12 text-center">
                      <img src="{{asset('/images/iconoFull.svg')}}" width="150" height="150"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <p class="font-bold">Ingrese su contraseña para proceder</p>
                      <p class="font-italic col-pink">- Tendrá que crear una cuenta nueva para ingresar a el sistema...</p>
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
                        <div class="form-line">
                            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirmar contraseña">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer row clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <button type="button" id="clear" onclick="borrar();" class="btn btn-danger btn-block waves-effect" data-dismiss="modal">Borrar</button>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <button type="button" onclick="" class="btn bg-pink btn-block waves-effect" data-dismiss="modal">Cancelar</button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function borrar(){
  alert('Se borrara :v');

  // $.ajax(url, {
  //   method: "POST",
  //   data: parametros,
  //   success: function (response) {
  //     if(response.errors){
  //       mensajeAjax('Error', 'Verifique sus datos', 'error');
  //       var errores = '<ul>';
  //       $.each(response.errors,function(indice,valor){
  //         //console.log(indice + ' - ' + valor);
  //         errores += '<li>' + valor + '</li>';
  //       });
  //       errores += '</ul>';
  //       notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
  //     } else{
  //       mensajeAjax('Correcto', response.message, 'success');
  //       window.setTimeout(function(){
  //         location.href = urlToRedirectPage;
  //       } ,1500);
  //     }
  //   },
  //   error: function (jqXHR, status, error) {
  //     mensajeAjax('Error', error, 'error');
  //   }
  // });
}
</script>

@stop
