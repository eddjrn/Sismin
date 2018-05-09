<h1>Hola {{$usuario->__toString()}}</h1>
  <h2>  Tienes recordatorios pendientes:</h2>
  <br>
    <ol>
        @foreach($compromisos as $compromiso_responsable)
            <li>Compromiso: {{$compromiso_responsable->compromisos->descripcion}}</li>
            <ul>
                <li>Tu tarea: {{$compromiso_responsable->tarea}}</li>
                <li>Fecha limite: {{$compromiso_responsable->compromisos->getLimite()}}</li>
            </ul>
            <br>
        @endforeach
    </ol>
    <br>
        <center><img src="{{asset('/images/correo.svg')}}" width="150" height="150"/></center>
    <br>
