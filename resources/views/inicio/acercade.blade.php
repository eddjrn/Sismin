@extends('Layout.layout')

@section('title')
Acerca de
@stop

@section('estilos')
@stop

@section('header')
@stop

@section('contenido')
<div class="card">
  <div class="row">
    <div class="p-l-75 p-t-40 p-b-12 col-md-6 "> <img style="float:left; max-height:150px;"  class="img-responsive"src="{{asset('/images/IPN2.JPG')}}" /> </div>
    <div class="p-r-75 p-t-40 p-b-12 col-md-6 " ><img style="float:right; max-height:150px"  class="img-responsive" src="{{asset('/images/UPIIZ2.png')}}"/></div>
  </div>

    <div class="header" align="center">
        <h2>
            <b><font color="teal">QUÉ ES LO QUE HACEMOS</font></b>
        </h2>
    </div>
    <div class="body">
        <p class="lead" align="center">
        <b>Sismin es su herramienta para auxiliar en la elaboración de las minutas
          de trabajo y dar seguimiento a los compromisos establecidos dentro de las
          mismas. Cree ordenes del día, tome minutas y dé seguimiento a los compromisos.</b>
        </p>
    <div class="header" align="center">
        <h2>
            <b><font color="teal">FUNCIONES CENTRALES DE SISMIN</font></b>
        </h2>
    </div>
        <p class="lead" align="justify">
          <h3>Orden del Día</h3>
        <b>
          Cree su agenda con AgreeDo y compártala con su equipo.
          Sus asistentes contribuyen a la reunión antes de comenzar.
           Esto reduce considerablemente el tiempo de reunión requerido.</b>
        </p>
        <p class="lead" align="justify">
          <h3>Minutas de Reunión.</h3>
        <b>
        Cree minutas de reunión, asigne tareas y comparta decisiones.</b>
        </p>
        <p class="lead" align="justify">
          <h3>seguimiento.</h3>
        <b>Dé seguimiento al progreso de sus proyectos y agende su próxima reunión.</b>
        </p>
    </div>
</div>

<div class="card">
    <div class="header" align="center">
        <h2>
            <b><font color="teal">Sistema auxiliar en la elaboración y seguimiento de las
minutas de reuniones de trabajo.(SISMIN)</font></b>
        </h2>
    </div>
    <div class="body">
        <p class="lead" align="justify">
          <h4>Elaborado por los alumnos:</br></h4>
        <b> Eduardo Javier Reyes Norman</br>
            Mayra Villavicencio Marquez</b>
        </p>
    </div>
</div>
</div>


@stop

@section('scripts')
@stop
