<h1>Hola {{$usuario->__toString()}}</h1>
  <h2>  Tienes compromisos pendientes:</h2>
  <br>
    <ol>
        @foreach($compromisos as $compromiso_responsable)
            <li>Compromiso: {{$compromiso_responsable->compromisos->descripcion}}</li>
            <ul>
                <li>De la reunión: {{$compromiso_responsable->compromisos->orden_dia->reunion->tipo_reunion->descripcion}}</li>
                <li>Del motivo: {{$compromiso_responsable->compromisos->orden_dia->reunion->motivo}}</li>
                <li>Tu tarea: {{$compromiso_responsable->tarea}}</li>
                <li>Tiempo limite: {{$compromiso_responsable->compromisos->getLimite()}}</li>
            </ul>
            <br>
        @endforeach
    </ol>

    <div align="center">
      <h5>Gracias,<br>
      Sistema auxiliar en la elaboración y seguimiento de las minutas de reuniones de trabajo.
      </h5>
    </div>
    <br>
      <img src="{{asset('/images/correo.svg')}}" width="150" height="150" style="display: block; margin-left: auto; margin-right: auto;"/>
    <br>
