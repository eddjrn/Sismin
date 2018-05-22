<h1>Hola {{$usuario->__toString()}}</h1>
  <h2> El moderador {{$reunion->moderador}} eliminó la reunión {{$reunion->tipo_reunion->descripcion}}, convocada para el dia {{$reunion->getFechaReunionLegible()}}.</h2><br><br>

  <div align="center">
    <h5>Gracias,<br>
    Sistema auxiliar en la elaboración y seguimiento de las minutas de reuniones de trabajo.
    </h5>
  </div>
  <br>
    <img src="{{asset('/images/correo.svg')}}" width="150" height="150" style="display: block; margin-left: auto; margin-right: auto;"/>
  <br>
