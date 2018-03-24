@extends('Layout.layout2')

@section('titulo')
Registro del motivo de la reunión
@stop

@section('estilos')
<meta name="csrf-token" content="{{ csrf_token() }}" /> <!--cabecera para que se puedan enviar peticiones POST desde javascript-->
<link  href="{{asset('/css/cropper/cropper.css')}}" rel="stylesheet">
<link href="{{asset('/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

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
            <form>
                <div class="msg">Dar de alta tipo de reunión</div>
                @if(isset($tipos))
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">list</i>
                    </span>
                    <a class="btn btn-lg bg-pink waves-effect" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Ver registros existentes
                    </a>
                </div>
                <div class="collapse scroll" id="collapseExample" style="overflow-y: scroll;">
                    <div class="well">
                      <div class="list-group" style="height:200px;">
                        @foreach($tipos as $tipo)
                          <button type="button" class="list-group-item" style="word-wrap: break-word;">{{$tipo->descripcion}}</button>
                        @endforeach
                      </div>
                    </div>
                </div>
                @endif

                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">description</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Gerente de ventas" required data-toggle="tooltip" data-placement="top" title="Ingrese la desdcripción de el tipo de usuario">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <a href="{{asset('/')}}" class="btn btn-block bg-pink waves-effect">Regresar</a>
                        </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <button type="button" class="btn btn-block bg-pink waves-effect" onclick="guardar()">Dar de alta</button>
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


<!-- SweetAlert Plugin Js -->
<script src="{{asset('/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function guardar(){
  var url = "{{asset('/tipoUsuario')}}";
  var urlToRedirectPage = "{{asset('/')}}";

  var descripcion = document.getElementById('descripcion').value;

    var formdata = new FormData();
    formdata.append('descripcion', descripcion);

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
