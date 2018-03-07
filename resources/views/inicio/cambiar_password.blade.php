@extends('Layout.layout2')

@section('titulo')
Cambiar contraseña
@stop

@section('estilos')
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
              <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Restablecer mi contraseña</button>

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
@stop
