 <title>Minuta de la reunión {{$minuta->reunion->tipo_reunion->descripcion}} </title>
 <div align="right"><img src="{{$minuta->reunion->tipo_reunion->imagen_logo}}" class="logo" width="100" height="100"></div>
 <center><h1 class="tipo">"{{$minuta->reunion->tipo_reunion->descripcion}}"</h1></center>
 <div class="DR" align="justify"><b>Datos de la reunión</b><hr>
<b>Fecha y Hora:</b> {{$minuta->reunion->fecha_reunion}}.<br>
<b>Lugar:</b> {{$minuta->reunion->lugar}}.<br>
<b>Motivo:</b> {{$minuta->reunion->motivo}}.<br>
<b>Reunión convocada por:</b> {{$minuta->reunion->moderador()->__toString()}}.<br><br>

<b>Participantes</b><hr>
  <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Rol dentro de la reunión</th>
          <th>Asistencia</th>
        </tr>
      </thead>
      <tbody>
        @foreach($minuta->reunion->convocados as $convocado)
        <tr>
          <td>{{$convocado->usuario->__toString()}}</td>
          <td>{{$convocado->rol->descripcion}}</td>
          <td>
            @if($convocado->asistencia == 1)
            Presente
            @else
            Ausente
            @endif</td>
        </tr>
        @endforeach
      </tbody>
  </table>
<b>Temas tratados / Descripción de los hechos</b><hr>
  <ol>
    @foreach($minuta->reunion->orden_dia as $orden)
    <li>{{$orden->descripcion}}
      <ul>
        <li>{{$orden->descripcion_hechos}}</li>
      </ul>
    </li>
    @endforeach
  </ol>

  <b>Compromisos asumidos</b><hr>
  <ol>
    @foreach($minuta->compromisos as  $c=> $compromiso)
    <li><b>Tema: </b>{{$compromiso->orden_dia->descripcion}}
      <ul>
        <li><b>Compromiso: </b>{{$compromiso->descripcion}}</li>
        <li><b>Fecha límite: </b>{{$compromiso->fecha_limite}}</li>
        <li><b>Responsables: </b></li>
        <ul>
          @foreach($minuta->compromisos[$c]->responsables as $responsable)
              <li>{{$responsable->usuario->__toString()}}</li>
          @endforeach
        </ul>
      </ul>
    </li>
    @endforeach
  </ol>

    <b>Compromisos asumidos opc2</b><hr>
    <table>
        <thead>
          <tr>
            <th>Tema</th>
            <th>compromiso</th>
            <th>Responsable(s)</th>
            <th>Fecha limite</th>
          </tr>
        </thead>
        <tbody>
          @foreach($minuta->compromisos as  $c=> $compromiso)
          <tr>
            <td>{{$compromiso->orden_dia->descripcion}}</td>
            <td>{{$compromiso->descripcion}}</td>
            <td>
              @foreach($minuta->compromisos[$c]->responsables as $responsable)
                   {{$responsable->usuario->__toString()}}<br>
              @endforeach</td>
            <td>{{$compromiso->fecha_limite}}</td>
          </tr>
          @endforeach
        </tbody>
    </table>

<b>Temas pendientes</b><hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tema</th>
            <th>Descripción del tema pendiente</th>
            <th>Motivo por el que quedo pendiente</th>
        </tr>
    </thead>
    <tbody>
      @foreach($minuta->temas_pendientes as $temaP)
      <tr>
          <td>{{$temaP->orden_dia->descripcion}}</td>
          <td>{{$temaP->descripcion}}</td>
          <td align="justify">{{$temaP->orden_dia->descripcion_hechos}}</td>
      </tr>
      @endforeach
    </tbody>
</table>

<b>Temas pendientes opc2</b><hr>
<ol>
  @foreach($minuta->temas_pendientes as $temaP)
  <li><b>Tema: </b>{{$temaP->orden_dia->descripcion}}
    <ul>
      <li><b>Descripción del tema pendiente: </b>{{$temaP->descripcion}}</li>
      <li><b>Motivo por el que quedo pendiente: </b>{{$temaP->orden_dia->descripcion_hechos}}</li>
      <li><b>Responsable: </b>{{$temaP->usuario->__toString()}}</li>
    </ul>
  </li>
  @endforeach
</ol>

@if(($minuta->notas)!="")
<b>Notas:</b><hr>
<label class="notas">{{$minuta->notas}}</label><br>
@endif

<b>Rúbircas</b><hr>
  @foreach($minuta->reunion->convocados as $convocado)
  <img src="{{$convocado->usuario->rubrica}}" class="rubrica" width="100" height="50" />
@endforeach<br>

<b>Rúbircas opc2</b><hr>
  <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Rol dentro de la reunión</th>
          <th>Rúbrica</th>
        </tr>
      </thead>
      <tbody>
        @foreach($minuta->reunion->convocados as $convocado)
        <tr>
          <td>{{$convocado->usuario->__toString()}}</td>
          <td>{{$convocado->rol->descripcion}}</td>
          <td><img src="{{$convocado->usuario->rubrica}}" class="rubrica" width="100" height="50" /></td>
        </tr>
        @endforeach
      </tbody>
  </table>

</div>


<style>
.logo{
  border-radius:50%;
-webkit-border-radius:50%;
margin: 1rem;
padding: 1rem;
}

.tipo{
  margin-top: 0;
  padding-top: 0;
  font-family:"Verdana";
  font-size: 22px;
}
h2{
  margin-top: 0;
  padding-top: 0;
  margin: 1rem;
  padding: 1rem;
  font-family: "Verdana";
  font-size: 16px;
}

.DR{
  margin-top: 0;
  padding-top: 0;
  margin: 1rem;
  padding: 1rem;
  font-size: 16px;
}
ul {
    list-style-type: square;
}
ol {
    list-style-type: decimal-leading-zero;
    padding-left: 2em;
}

table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px;
  background-color: transparent;
  border-spacing: 0;
  border-collapse: collapse;
}
th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
.notas {background-color:yellow;}

</style>
