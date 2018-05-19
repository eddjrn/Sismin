@extends('Layout.layout')

@section('titulo')

@stop

@section('estilos')
<!--cabecera para que se puedan enviar peticiones POST desde javascript-->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{asset('/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />

<!-- Wait Me Css -->
<link href="{{asset('/plugins/waitme/waitMe.css')}}" rel="stylesheet" />

<!-- Bootstrap Select Css -->
<link href="{{asset('/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

<!-- JQuery DataTable Css -->
<link href="{{asset('/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<!-- JQuery Nestable Css -->
<link href="{{asset('/plugins/nestable/jquery-nestable.css')}}" rel="stylesheet" />
<link href="{{asset('/css/Calendar/fullcalendar.min.css')}}" type="text/css" rel="stylesheet" />
<link href="{{asset('/css/Calendar/fullcalendar.print.min.css')}}" rel='stylesheet' media='print' />
<style>

body {
	margin: 0;
	padding: 0;
	font-size: 14px;
}

#top,
#calendar.fc-unthemed {
	font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
}

#top {
	background: #eee;
	border-bottom: 1px solid #ddd;
	padding: 0 10px;
	line-height: 40px;
	font-size: 12px;
	color: #000;
}

#top .selector {
	display: inline-block;
	margin-right: 10px;
}

#top select {
	font: inherit; /* mock what Boostrap does, don't compete  */
}

.left { float: left }
.right { float: right }
.clear { clear: both }

#calendar {
	max-width: 900px;
	margin: 40px auto;
	padding: 0 10px;
}
</style>
@stop

@section('cabecera')
Agenda
@stop

@section('contenido')
<!-- Basic Card -->
@if(count($eventos) > 0)
<?php $icono_vacio = false; ?>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
            </div>
						  <div id='calendar'></div><br><br>
        </div>
    </div>
  </div>
	@else
	<?php $icono_vacio = true; ?>
	@endif

	@if($icono_vacio)
	  <img src="{{asset('/images/iconoFull_gris.svg')}}" style="display: block; margin: auto;" width="250" height="250"/>
	  <h2 class="align-center col-blue-grey">Aún no tienes compromisos agendados en esta sección</h2>
	  <h2 class="align-center col-blue-grey"><i class="material-icons">tag_faces</i></h2>
	@endif

	<div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" >
				<div class="modal-dialog modal-sm" role="document" id="rubricaCanvas">
						<div class="modal-content">
								<div class="modal-header">
										<h4 class="modal-title" align="center"><span id="modalTitle"></span></h4>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-lg-12">
												<div class="row clearfix">
														<div class="col-md-12">
															@if(isset($eventos))
															<div class="input-group">
																<span class="input-group-addon">
																		<i class="material-icons">list</i>
																</span>
																<button class="colorBoton" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
																		Convocados
																</button>
															</div>
															<div class="collapse" id="collapseExample">
																	<div class="well bar" style="height: 200px; overflow-y: scroll;">
																		<div class="list-group">
																				<button type="button" class="list-group-item" style="word-wrap: break-word;">
																					<div class="media">
																							<div class="media-body"><span id="convocados"> </span></div>
																					</div>
																				</button>
																		</div>
																	</div>
															</div>
															<br/>
															@endif
														</div>
												</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
												<div class="row clearfix">
														<div class="col-md-12">
															@if(isset($eventos))
															<div class="input-group">
																<span class="input-group-addon">
																		<i class="material-icons">list</i>
																</span>
																<button class="colorBoton" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
																		Temas Pendientes
																</button>
															</div>
															<div class="collapse" id="collapseExample2">
																	<div class="well bar" style="height: 200px; overflow-y: scroll;">
																		<div class="list-group">
																				<button type="button" class="list-group-item" style="word-wrap: break-word;">
																					<div class="media">
																							<div class="media-body"><span id="temas_pendientes"> </span></div>
																					</div>
																				</button>
																		</div>
																	</div>
															</div>
															<br/>
															@endif
														</div>
												</div>
										</div>
									</div>
									<div align="justify"><h4> Moderador:</h4> <span id="moderador"></span></div>
									<div align="justify"><h4> Secretario:</h4> <span id="secretario"></span></div>
									<div align="justify"><h4>Fecha:</h4> <span id="eventStart"></span></div>
									<div class="modal-footer row clearfix">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<a class="colorBoton" id="modalURLM" target="_blank">ver minuta</a>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-6">
											<a class="colorBoton" id="modalURLC" target="_blank">ver convocatoria</a>
										</div>
									</div>
									<div class="modal-footer row clearfix">
										<button type="button" id="clear" data-dismiss="modal" class="colorBoton" onClick="limpiarDialogo();">Cerrar</button>
									</div>
								</div>
						</div>
				</div>
		</div>

		<div class="modal fade" id="fullCalModalC" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-sm" role="document" id="rubricaCanvas">
							<div class="modal-content">
									<div class="modal-header">
											<h4 class="modal-title" align="center"><span id="modalTitleC"></span></h4>
									</div>
									<div class="modal-body">
										<div align="justify"><h4>Status: </h4><span id="modalStatus"></span>.</div>
										<div align="justify"><h4>Pertenece a la reunión: </h4><span id="modalMinuta"></span>.</div>
										<div align="justify"><h4>Responsabilidad: </h4><span id="modalTema"> </span>: <span id="modalResponsabilidad"></span>.</div>
										<div align="justify"><h4>Fecha: </h4><span id="modalFecha"></span>.</div>
										<div class="modal-footer row clearfix">
											<button type="button" id="clear" data-dismiss="modal" class="colorBoton">Cerrar</button>
										</div>
									</div>
							</div>
					</div>
			</div>

@stop

@section('scripts')

<script src="{{asset('/js/Calendar/lib/moment.min.js')}}"></script>
<script src="{{asset('/js/Calendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('/js/Calendar/locale/es.js')}}"></script>
<script>
var colorCheck = "chk-col-cyan";
var colorBtn = "btn bg-cyan waves-effect";
var colorBtnDis = "btn btn-default waves-effect";
var fondo = "bg-cyan";
var tema = "theme-cyan";
var colorSpinner = '#8BC34A';
var textoColor = "col-cyan";
</script>

<script>

$(document).ready(function() {
		var date = new Date();
		var dateString="";
		var newDate = new Date();

		// Get the month, day, and year.
		dateString += (newDate.getMonth() + 1) + "/";
		dateString += newDate.getDate() + "/";
		dateString += newDate.getFullYear();

		// Cambia estilos
		// Cuerpo
		$('body').removeClass('theme-cyan');
		$('body').addClass(tema);
		// Botones
		$('.colorBoton').addClass(colorBtn);
		// Checkboxs
		$('.chk-col-teal').addClass(colorCheck);
		$('.chk-col-teal').removeClass('chk-col-teal');
		// Fondos generales y objetos ocultos
		$('.fondo').addClass(fondo);
		$('.oculto').hide();
		//texto
		$('.texto').addClass(textoColor);


	/* initialize the calendar
	-----------------------------------------------------------------*/
	 		$('#calendar').fullCalendar({
	 			themeSystem: 'bootstrap3',
				 header: {
					 left: 'prev,next today',
					 center: 'title',
					 right: 'month,agendaWeek,agendaDay,listMonth'
				 },
				 defaultDate: dateString,
				 weekNumbers: true,
				 navLinks: true, // can click day/week names to navigate views
				 editable: false,
				 eventLimit: true, // allow "more" link when too many events
				 timeFormat: 'h(:mm)a',
				 events: [
 				  @foreach($eventos as $e=>$evento)
 				  {
 				    id: '{{$evento->id_reunion}}',
 				    title:'{{$evento->tipo_reunion->descripcion}}',
 				    description:'{{$evento->motivo}}',
 				    start: moment('{{$evento->fecha_reunion}}'),
 				    moderador: '{{$evento->moderador}}',
 				    secretario: '{{$evento->secretario}}',
 				    convocados: [
 				    @foreach($evento->convocados as $convocado)
 				      {
 				        con: '{{$convocado->usuario->__toString()}}',
 				      },
 				    @endforeach
 				    ],
 				    temasPendientes:[
 				      @if(empty($datos[$e]))
 				      {
 				        tem: 'esta reunion no tiene temas pendientes',
 				      },
 				      @else
 				      @foreach($datos[$e] as $tema)
 				        {
 				          tem: '{{$tema->descripcion}}',
 				        },
 				      @endforeach
 				      @endif

 				      ],
 				    convocatoria: "{{asset('/pdf')}}/{{$evento->id_reunion}}/{{$evento->codigo}}",
 				    minuta: "{{asset('/pdf_minuta')}}/{{$evento->minuta->id_minuta}}/{{$evento->minuta->codigo}}",
 				    codigo:'{{$evento->minuta->getOriginal()["fecha_elaboracion"]}}',
 				    hora: '{{$evento->getFechaReunionLegible()}}',
 				    allDay: false,
 				    backgroundColor: '#A6113C',
 				    borderColor:'#820F20',
 				    color:'#ffffff',
 				    className:'info',
 				  },
 				  @endforeach
 				  @foreach($compromisos as $key=>$compromiso)
 				  {
 				    title:'{{$compromiso->descripcion}}',
 				    tarea:'{{$CR[$key]->tarea}}',
 				    start: new Date("{{$compromiso->getOriginal()['fecha_limite']}}"),
 				    hora: '{{$compromiso->fecha_limite}}',
 				    status: '{{$compromiso->finalizado}}',
 				    reunion:'{{$compromiso->minuta->reunion->tipo_reunion->descripcion}}',
 				    temaOD:'{{$compromiso->orden_dia->descripcion}}',
 				    allDay: false,
 				    backgroundColor: '#3498db',
 				    borderColor:'#aed6f1',
 				    color:'#ffffff',
 				    className:'info',
 				  },
 				  @endforeach
 				],
 				eventClick:  function(event, jsEvent, view) {
 				if(event.convocados != null){
 				 $('#modalTitle').html(event.title);
 				  for (var i = 0; i < event.convocados.length; i++) {
 				     $('#convocados').html($('#convocados').html()+"<b>"+(i+1)+": "+`${event.convocados[i].con}`+"</b></br>");
 				  }

 				  for (var k = 0; k < event.temasPendientes.length; k++) {
 				     $('#temas_pendientes').html($('#temas_pendientes').html()+`${event.temasPendientes[k].tem}`+"</b></br>");
 				  }
 				 $('#moderador').html(event.moderador);
 				 $('#secretario').html(event.secretario);
 				 $('#eventStart').html(event.hora);
 				 $('#modalURLC').attr('href',event.convocatoria);
 				 if(event.codigo == null || event.codigo =="")
 				 {
 				    $('#modalURLM').hide();
 				 }else{
 				    $('#modalURLM').show();
 				     $('#modalURLM').attr('href',event.minuta);
 				 }
 				 $('#fullCalModal').modal();
 				}else{
 				$('#modalTitleC').html(event.title);
 				if(event.status ==1){
 				$('#modalStatus').html('Finalizado');
 				}else{
 				 $('#modalStatus').html('En proceso');
 				}
 				$('#modalMinuta').html(event.reunion);
 				$('#modalResponsabilidad').html(event.tarea);
 				$('#modalTema').html(event.temaOD);
 				$('#modalFecha').html(event.hora);
 				$('#fullCalModalC').modal();
 				}
 				 return false;
 				 },
		 eventAfterRender: function(event, element, view) {
		 var width = $(element).height();
		 // Check which class the event has so you know whether it's half or quarter width
		 $(element).hasClass(".fc-widget-content")
		   cellheight = 30;
		 $(element).css('height', cellheight + 'px');
		 }
	});

});
function limpiarDialogo(){
	$('#temas_pendientes').html("");
	$('#convocados').html("");
}
</script>

@stop
