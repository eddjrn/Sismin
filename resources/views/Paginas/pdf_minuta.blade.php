 <title>Minuta de la reunión {{$minuta->reunion->tipo_reunion->descripcion}} </title>
 <div align="right"><img src="{{$minuta->reunion->tipo_reunion->imagen_logo}}" class="logo" width="100" height="100"></div>
 <div class="DR"><center><h1>"{{$minuta->reunion->tipo_reunion->descripcion}}"</h1></center>
<table>
  <caption><b>Datos de la reunón</b></caption>
  <caption><hr></caption>
    <thead>
    </thead>
    <tbody>
      <tr>
          <td><b>Fecha y Hora de inicio</b></td>
          <td>{{$minuta->reunion->getFechaReunionLegible()}}</td>
      </tr>
      <tr>
          <td><b>Fecha y Hora de termino</b></td>
          <td>{{$minuta->getFechaElaboracionLegible()}}</td>
      </tr>
      <tr>
          <td><b>Lugar</b></td>
          <td>{{$minuta->reunion->lugar}}</td>
      </tr>
      <tr>
          <td><b>Motivo</b></td>
          <td>{{$minuta->reunion->motivo}}</td>
      </tr>
      <tr>
          <td><b>Reunión convocada por</b></td>
          <td>{{$minuta->reunion->moderador}}</td>
      </tr>
    </tbody>
</table>

  <table>
    <caption><b>Participantes</b></caption>
    <caption><hr></caption>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Rol dentro de la reunión</th>
          <th>Puesto</th>
          <th>Asistencia</th>
        </tr>
      </thead>
      <tbody>
        @foreach($minuta->reunion->convocados as $convocado)
        <tr>
            <td>{{$convocado->usuario->__toString()}}</td>
            <td>{{$convocado->puesto->descripcion}}</td>
            <td>{{$convocado->rol()}}</td>
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

 <table>
      <caption><b>Compromisos asumidos</b></caption>
      <caption><hr></caption>
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
                    <li>{{$responsable->usuario->__toString()}}</li>
                @endforeach
            </td>
            <td>{{$compromiso->fecha_limite}}</td>
          </tr>
          @endforeach
        </tbody>
    </table>
@if(count($minuta->temas_pendientes) > 0)
<table class="table table-striped">
  <caption><b>Temas pendientes</b></caption>
  <caption><hr></caption>
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
@endif

@if(($minuta->notas)!="")
<b>Notas:</b><hr>
<label class="notas">{{$minuta->notas}}</label><br><br>
@endif

  <table>
    <caption><b>Rúbircas</b></caption>
    <caption><hr></caption>
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
          <td>{{$convocado->rol()}}</td>
          <td><img src="{{$convocado->usuario->rubrica}}" class="rubrica" width="100" height="100" /></td>
        </tr>
        @endforeach
      </tbody>
  </table>

</div>


<style>
.logo{
  border-radius:50%;
-webkit-border-radius:50%;
margin-bottom: 0px;
margin-left: 1rem;
margin-right: 1rem;
margin-top: 1rem;
padding-top: 1rem;
padding-left: 1rem;
padding-right: 1rem;
padding-bottom: 0px;
}
.DR{
  margin-bottom: 0px;
  margin-left: 1rem;
  margin-right: 1rem;
  margin-top: 0px;
  padding-top: 0px;
  padding-left: 1rem;
  padding-right: 1rem;
  padding-bottom: 0rem;
  font-size: 16px;
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
th, td{
    text-align: left;
    padding: 2px;
}
caption {
    text-align: left;
    padding: 0px;
}
tr:nth-child(even) {background-color: #f2f2f2;}
.notas {background-color:yellow;}

</style>
