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
            <div class="body">
              Sismin es su herramienta para auxiliar en la elaboración de las minutas
              de trabajo y dar seguimiento a los compromisos establecidos dentro de las
              mismas. Cree ordenes del día, tome minutas y dé seguimiento a los compromisos.
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Funciones centrales del sistema
                </h2>
            </div>
            <div class="body">
              <h5>Orden del Día.</h5>
              Cree su agenda con AgreeDo y compártala con su equipo.
              Sus asistentes contribuyen a la reunión antes de comenzar.
              Esto reduce considerablemente el tiempo de reunión requerido.
              <h5>Minutas de Reunión.</h5>
              Cree minutas de reunión, asigne tareas y comparta decisiones.
              <h5>seguimiento.</h5>
              Dé seguimiento al progreso de sus proyectos y agende su próxima reunión.
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
            <div class="body">
              <h5>Elaborado por los alumnos:</h5>
              <ul>
                <li>Eduardo Javier Reyes Norman</li>
                <li>Mayra Villavicencio Marquez</li>
              </ul>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Card -->
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
    <img class="imagen hidden-xs" src="{{asset('/images/ipn.png')}}"/>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
    <img class="imagen" src="{{asset('/images/upiiz.png')}}"/>
  </div>
</div>

@stop

@section('scripts')
@stop
