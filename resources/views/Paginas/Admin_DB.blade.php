@extends('Layout.layout')

@section('titulo')
Respaldos
@stop

@section('estilos')
<!--cabecera para que se puedan enviar peticiones POST desde javascript-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('cabecera')
Base de datos
@stop

@section('contenido')
<!-- Tabs With Icon Title -->

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-col-pink" role="tablist">
                  <li role="presentation">
                        <a href="#home_with_icon_title" data-toggle="tab">
                            <i class="material-icons">schedule</i> Respaldos.
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#profile_with_icon_title" data-toggle="tab">
                            <i class="material-icons">restore</i> Recuperación de respaldos.
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade" id="home_with_icon_title">
                      <strong>Para realizar un respaldo de toda la base de datos de las minutas y reuniones presione el botón realizar respaldo.</strong>
                      <br>
                      <button type="button" id="btnRespaldo" class="btn bg-pink waves-effect" data-toggle="modal" data-target="#modalRespaldo">Realizar respaldo</button>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">

                    </div>
               </div>
            </div>
     </div>
  </div>
</div>

<div class="modal fade" id="modalRespaldo" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel2">Realizar respaldo</label></h4>
            </div>
            <div class="modal-body" >
              <blockquote class="font-15">
                <p class="align-justify">
                  Al realizar éste tipo de respaldo, los datos existentes en el sistema (Toda información relacionada con las minutas y convocatorias de reunión) serán limpiados y pasados a un respaldo.
               </p>
             </blockquote>
                <p class="font-bold col-pink align-center"> ¿Desea continuar?</p>
            <div class="modal-footer">
              <div class="row">
                <div class="col-md-6">
                  <button type="button" class="btn btn-block bg-pink waves-effect" data-dismiss="modal">Cancelar</button>
                </div>
                <div class="col-md-6">
                  <button type="button" class="btn btn-block bg-pink waves-effect" data-dismiss="modal" id="realizarR" onclick="respaldo()">Aceptar</button>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
<script src="{{asset('/js/treeview/easyTree.js')}}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var colorSpinner = '#8BC34A';
var datos= null;

function archivo(datos, nombre_archivo, tipo){

  var archivo = new Blob([datos],{ type: "text/plain"});
  var a = document.createElement("a"),url = URL.createObjectURL(archivo);
  var date = Date.now();
  a.href=url;
  a.download = nombre_archivo + date + tipo;
  document.body.appendChild(a);
  a.click();
  setTimeout(function(){
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
  },0);
}

function respaldo(){

 inicioSpinner();

$.ajax({
   type:'POST',
   url: "{{asset('/crear_respaldo')}}",
   data: true,
   processData:false,
   contentType:false,
   success:function(result){
     if(result.errores){
       finSpinner();
       mensajeAjax('Error', 'Verifique sus datos', 'error');
       var errores = '<ul>';
       $.each(result.errores,function(indice,valor){
         errores += '<li>' + valor + '</li>';
       });
       errores += '</ul>';
       notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
     } else{
       mensajeAjax('Registro correcto', result.mensaje,'success');
       notificacionAjax('bg-green',"Por favor guarde el archivo en un lugar seguro", 10000,  'bottom', 'center', null, null);
       datos= result.datos;
       archivo(datos,"usuarios",".SisMin");
       finSpinner();
     }
    },
    error: function (jqXHR, status, error) {
      finSpinner();
      mensajeAjax('Error', error, 'error');
    }
});
}


</script>
@stop
