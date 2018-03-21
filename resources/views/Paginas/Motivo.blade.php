@extends('Layout.layout2')

@section('titulo')
Registro del motivo de la reunión
@stop

@section('estilos')

@stop

@section('cabecera')

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
            <form id="reg_motivo" method="POST" route = "{{asset('/Motivo')}}" >
              {{csrf_field()}}
                <div class="msg">Dar de alta tipo de reunión</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">camera_enhance</i>
                    </span>
                    <div class="form-line">
                        <input type="file" class="form-control" name="logo"  required data-toggle="tooltip" data-placement="top" title="Logo de la organización/empresa">
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">description</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="nombre" placeholder="Descripción" required data-toggle="tooltip" data-placement="top" title="Ingrese el tipo de reunión">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <a href="{{asset('/')}}" class="btn btn-block bg-pink waves-effect">Regresar</a>
                        </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <button class="btn btn-block bg-pink waves-effect" type="submit">Dar de alta</button>
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

@stop
