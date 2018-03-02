@extends('Layout.layout2')

@section('title')
Registrar a un nuevo usuario
@stop

@section('estilos')
<script src="{{asset('/js/atrament.min.js')}}"></script>


@stop

@section('contenido')
<div class="login-box">
    <div class="logo">
        <div class="row">
          <div class="col-xs-6 col-xs-offset-3">
            <imform {
				z-index: 3;
				position: fixed;
				top: 300;
				left: 100;
				background: rgba(0, 0, 0, 0.7);
				padding: 1em;
				color:white;
			}g src="{{asset('/images/iconoFull.svg')}}" width="150" height="150"/>
          </div>
        </div>
        <a href="javascript:void(0);"><b>SisMin</b></a>
    </div>
        <div class="card">
            <div class="body">
                <div class="demo-masked-input">
                <form id="sign_up" method="POST" route="{{asset('/registro')}}">
                  {{csrf_field()}}
                    <div class="msg">Registrar un nuevo usuario</div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control nombre" name="nombre" placeholder="Nombre" required autofocus>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                          <input type="text" class="form-control apellido_paterno" name="apellido_paterno" placeholder="Apellido paterno" required autofocus>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                          <input type="text" class="form-control apellido_materno" name="apellido_materno" placeholder="Apellido materno" required autofocus>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control email" name="correo_electronico" placeholder="Ej: ejemplo@ejemplo.com" required autofocus>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="6" placeholder="contraseña" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <script src="../../plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
                        <div class="fordemo-masked-inputm-line">
                            <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirmar contraseña" required>
                        </div>
                    </div>
                      <button type="button" class="btn btn-block btn-lg bg-pink waves-effect" data-toggle="modal" data-target="#defaultModal">Rúbrica</button>
                      <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Registrarme</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="{{asset('/login')}}">¿Ya estás registrado?</a>
                    </div>
                </form>
            </divdemo-masked-input>
        </div>
        <div class="logo">
          <small>Sistema auxiliar en la elaboración y seguimiento de las minutas de reuniones de trabajo.</small>
        </div>
      </div>
    </div>


<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="largeModalLabel">Ingresar rúbrica</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <canvas id="sketcher" ></canvas>
              </div>

                <div class="row">
                  <input type="range" min="0" max="1" onchange="atrament.opacity = parseFloat(event.target.value);" value="1" step="0.05" autocomplete="off">
                </div>
              <div class="modal-footer row" >
                <div class="col-md-4">
                  <button type="button" id="clear" onclick="event.preventDefault(); atrament.clear();" class="btn btn-block btn-lg bg-pink waves-effect">Borrar</button>
                </div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-block btn-lg bg-pink waves-effect">Guardar</button>
                </div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-block btn-lg bg-pink waves-effect" data-dismiss="modal">Cancelar</button>
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
  var atrament = atrament(canvas, window.innerWidth, window.innerHeight);

  var clearButton = document.getElementById('clear');
  canvas.addEventListener('dirty', function(e) {
    clearButton.style.display = atrament.dirty ? 'inline-block' : 'none';
  });
</script>
@stop
