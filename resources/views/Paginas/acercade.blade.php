@extends('Layout.layout')

@section('titulo')
Acerca de
@stop

@section('estilos')
<style>
.imagen {
  height: 150px;
  width: auto;
}
</style>
@stop

@section('cabecera')
Acerca del sistema
@stop

@section('contenido')

<!-- Basic Card -->
<div class="row clearfix">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    ¿Qué es lo que hacemos?
                </h2>
            </div>
            <div class="body" align="justify">
              Sismin es su herramienta para auxiliar en la elaboración de las minutas
              de trabajo y dar seguimiento a los compromisos establecidos dentro de las
              mismas. Cree ordenes del día, tome minutas y dé seguimiento a los compromisos.
            </div>
        </div>
          <br><br>  <br><br>  <br><br>
          <center><img class="imagen hidden-xs" src="{{asset('/images/ipn.png')}}"/></center>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Funciones centrales del sistema
                </h2>
            </div>
            <div class="body" align="justify">
              <h5>Crear nuevas reuniones</h5>
              <span>Al momento de crear una nueva reunión usted podrá realizar lo siguiente:</span>
              <lo><ul>
                <li>Agregar las personas convocadas y su respectiva función dentro de la reunión.</li>
                <li>Crear la orden del día de la reunión.</li>
                <li>Asignar responsables a la orden del día.</li>
                <li>Asignar la función de secretario de la reunión.</li>
                <li>Al finalizar se enviará una notificación con la convocatoria de dicha reunión a cada una de las personas convocadas.</li>
              </ul></lo>
              <h5>Elaborar minutas de cada reunión.</h5>
              <lo><ul>
                <li>Crear minutas de la reunión.</li>
                <li>Asignar los compromisos.</li>
                <li>Asignar los responsables.</li>
                <li>Asignar los temas pendientes.</li>
                <li>Agregar las notas a la minuta de reunión.</li>
              </ul></lo>
              <h5>Seguimiento.</h5>
              <lo><ul>
                <li>Dar seguimiento a sus reuniones mediante el envío de correos electrónicos.</li>
                <li>Dar seguimiento a los compromisos establecidos dentro de las minutas de reunión mediante el envío de correos electrónicos.</li>
              </ul></lo>
        </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                  SisMin
                  <small>Sistema auxiliar en la elaboración y seguimiento de las minutas de reuniones de trabajo.</small>
                </h2>
            </div>
            <div class="body" align="justify">
              <h5>Elaborado por los alumnos:</h5>
              <ul>
                <li>Eduardo Javier Reyes Norman</li>
                <li>Mayra Villavicencio Marquez</li>
              </ul>
            </div>
        </div>
        <br><br>  <br><br>  <br>
        <center><img class="imagen" src="{{asset('/images/upiiz.png')}}"/></center>
    </div>
</div>
<!-- #END# Basic Card -->
<!-- <div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
    <img class="imagen hidden-xs" src="{{asset('/images/ipn.png')}}"/>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
    <img class="imagen" src="{{asset('/images/upiiz.png')}}"/>
  </div>
</div> -->

@stop

@section('scripts')
@stop
