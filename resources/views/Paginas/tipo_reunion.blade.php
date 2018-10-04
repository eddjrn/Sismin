@extends('Layout.layout2')

@section('titulo')
Registro del motivo de una reunión
@stop

@section('estilos')
<meta name="csrf-token" content="{{ csrf_token() }}" /> <!--cabecera para que se puedan enviar peticiones POST desde javascript-->
<link  href="{{asset('/css/cropper/cropper.css')}}" rel="stylesheet">
<!-- Bootstrap Select Css -->
<link href="{{asset('/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@stop

@section('contenido')
<div class="login-box">
    <div class="logo">
        <div class="row">
          <div class="col-xs-6 col-xs-offset-3">
            <img src="{{asset('/images/tipo_reunion.svg')}}" width="150" height="150"/>
          </div>
        </div>
        <a href="javascript:void(0);"><b>SisMin</b></a>
    </div>
    <div class="card">
        <div class="body">
            <form>
                <div class="msg">Dar de alta grupo de reunión</div>

                @if(isset($tipos))
                <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">list</i>
                  </span>
                  <button class="btn btn-lg bg-pink waves-effect" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                      Ver registros existentes
                  </button>
                </div>
                <div class="collapse" id="collapseExample">
                    <div class="well bar" style="height: 200px; overflow-y: scroll;">
                      <div class="list-group">
                        @foreach($tipos as $tipo)
                          <button type="button" class="list-group-item" onclick="aux({{$tipo->id_tipo_reunion}},'{{$tipo->descripcion}}',{{$tipo->imagen_logo}})"style="word-wrap: break-word;" data-toggle="modal" data-target="#adminModalEdit">
                            <div class="media">
                                <div class="media-left">
                                    <a href="javascript:void(0);">
                                        <img class="media-object" src="{{$tipo->imagen_logo}}" width="64" height="64">
                                    </a>
                                </div>
                                <div class="media-body">
                                <span class="font-bold">
                                {{$tipo->descripcion}}</br>
                                Administrador:</span>{{$tipo->administrador}}</div>
                            </div>

                          </button>
                        @endforeach
                      </div>
                    </div>
                </div>
                <br/>
                @endif

                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">camera_enhance</i>
                    </span>
                    <button type="button" class="btn btn-lg bg-pink waves-effect" data-toggle="modal" data-target="#photoModalEdit">Logo de la organización/empresa</button>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">description</i>
                    </span>
                    <div class="form-line">
                        <input type="text" id="descripcion" class="form-control" name="descripcion" placeholder="Descripción" data-toggle="tooltip" data-placement="top" title="Ingrese el grupo de reunión">
                    </div>
                </div>
                <div class="input-group">
                  <select id="administrador_grupo" class="form-control show-tick" data-live-search="true" autocomplete="off">
                      <option value="0">Seleccionar</option>
                      @foreach($usuarios as $usuario)
                        <option value="{{$usuario->id_usuario}}">{{$usuario->__toString()}}</option>
                      @endforeach
                  </select>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <a href="{{asset('/')}}" class="btn btn-block bg-pink waves-effect">Regresar</a>
                        </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <button class="btn btn-block bg-pink waves-effect registrar" type="button" id="registrar" >Dar de alta</button>
                    </div>
                </div>
            </form>""
        </div>
    </div>

    <div class="logo">
      <small>Sistema auxiliar en la elaboración y seguimiento de las minutas de reuniones de trabajo.</small>
    </div>
</div>

    <!-- Small Size -->
<div class="modal fade" id="adminModalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel2">Editar grupo <label id="nombreG" value=""></label></h4>
            </div>
            <div class="modal-body">
              <form>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">camera_enhance</i>
                    </span>
                    <button type="button" class="btn btn-lg bg-pink waves-effect" data-toggle="modal" data-target="#photoModalEdit" >Logo de la organización/empresa</button>
                </div>
                <label>Cambiar nombre del grupo</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">description</i>
                    </span>
                    <div class="form-line">
                        <input type="text" id="desc" class="form-control" value="" name="descripcion2" placeholder="Descripción" data-toggle="tooltip" data-placement="top" title="Ingrese el nuevo nombre del grupo de reunión">
                    </div>
                </div>
                <label>Nuevo administrador</label>
                <div class="input-group">
                  <select id="Copc" class="form-control show-tick" data-live-search="true" autocomplete="off">
                      <option value="0">Seleccionar</option>
                      @foreach($usuarios as $usuario)
                        <option value="{{$usuario->id_usuario}}">{{$usuario->__toString()}}</option>
                      @endforeach
                  </select>
                </div>
            </div>
            <div class="modal-footer">
              <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
                <button type="button" class="btn btn-block bg-pink waves-effect registrar" data-dismiss="modal" id="editarG">Aceptar</button>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>


<div class="modal fade" id="photoModalEdit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="smallModalLabel">Logo de la organización/empresa</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-lg-12 text-center">
                  <img id="image" class="fotoE" src="{{asset('/images/imagen.svg')}}" alt="Picture" width="150" height="150"/>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="text-center">
                  <button id="reset" type="button" class="btn bg-pink waves-effect" data-toggle="tooltip" data-placement="top" title="Reiniciar">
                      <i class="material-icons">undo</i>
                  </button>
                  <button id="rotateRight" type="button" class="btn bg-pink waves-effect " data-toggle="tooltip" data-placement="top" title="Rotar a la derecha">
                      <i class="material-icons">rotate_right</i>
                  </button>
                  <button id="rotateLeft" type="button" class="btn bg-pink waves-effect " data-toggle="tooltip" data-placement="top" title="Rotar a la izquierda">
                      <i class="material-icons">rotate_left</i>
                  </button>

                   <label class="btn bg-pink waves-effect btn-upload" for="inputImage" data-toggle="tooltip" title="Subir imagen" data-placement="top">
                     <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif">
                     <i class="material-icons">cloud_upload</i>
                   </label>
                </div>
              </div>

          </div>
          <div class="modal-footer row clearfix">
            <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
              <button type="button" class="btn btn-block bg-pink waves-effect" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
            </form>
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
  });""

  var UrlToPostForm = "{{asset('/tipo_reunion')}}";
  var UrlToRedirectPage = "{{asset('/')}}";
  var urlA = "{{asset('/tipo_reunion_admin')}}";
</script>
<!-- Select Plugin Js -->
<script src="{{asset('/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<script src="{{asset('/js/cropper/cropper.js')}}"></script>
<script src="{{asset('/js/paginas/tipo_reunion.js')}}"></script>

@stop
