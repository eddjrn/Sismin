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

@stop

@section('contenido')
<!-- Basic Card -->
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
              <h1>Agenda</h1>
            </div>
						  <div id='calendar'></div><br><br>
        </div>
    </div>
  </div>

	<div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-sm" role="document" id="rubricaCanvas">
						<div class="modal-content">
								<div class="modal-header">
										<h4 class="modal-title" id="largeModalLabel"><span id="modalTitle"></span></h4>
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
																<button class="btn btn-lg bg-pink waves-effect" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
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
									<div><h2> Moderador: </h2><span id="moderador"></span></div>
									<div><h2> Secretario: </h2><span id="secretario"></span></div>
									<div> <h2>Fecha:</h2> <span id="eventStart"></span></div>
									<div class="modal-footer row clearfix">
											<button type="button" id="clear" data-dismiss="modal" class="btn bg-pink btn-block waves-effect" onclick="cancelarSecre()">Cancelar</button>
									</div>
								</div>
						</div>
				</div>
		</div>

		<div class="modal fade" id="fullCalModalC" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-sm" role="document" id="rubricaCanvas">
							<div class="modal-content">
									<div class="modal-header">
											<h4 class="modal-title" id="largeModalLabel"><span id="modalTitleC"></span></h4>
									</div>
									<div class="modal-body">
										<div><h2> Pertenece a la minuta: </h2><span id="modalMinuta"></span></div>
										<div><h2> Status: </h2><span id="modalStatus"></span></div>
										<div><h2> Responsabilidad: </h2><span id="modalResponsabilidad"></span></div>
										<div> <h2>Fecha:</h2> <span id="modalFecha"></span></div>
										<div class="modal-footer row clearfix">
												<button type="button" id="clear" data-dismiss="modal" class="btn bg-pink btn-block waves-effect" onclick="cancelarSecre()">Cancelar</button>
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
$(document).ready(function() {
		var date = new Date();
		var n=0;
		var con=new Array();

	/* initialize the calendar
	-----------------------------------------------------------------*/

	 		$('#calendar').fullCalendar({
	 			themeSystem: 'bootstrap3',
				 header: {
					 left: 'prev,next today',
					 center: 'title',
					 right: 'month,agendaWeek,agendaDay,listMonth'
				 },
				 defaultDate: '2018-04-18',
				 weekNumbers: true,
				 navLinks: true, // can click day/week names to navigate views
				 editable: false,
				 eventLimit: true, // allow "more" link when too many events
				 timeFormat: 'h(:mm)a',
		  events: [
				@foreach($eventos as $evento)
				{
					id: '{{$evento->id_reunion}}',
					title:'{{$evento->tipo_reunion->descripcion}}',
					description:'{{$evento->motivo}}',
					start: new Date("{{$evento->getOriginal()['fecha_reunion']}}"),
					moderador: '{{$evento->moderador()->__toString()}}',
					secretario: '{{$evento->secretario()->__toString()}}',
					convocados: [
						 @foreach($evento->convocados as $convocado)
						{
							con: '{{$convocado->usuario->__toString()}}',
						},
					@endforeach
					],
					hora: '{{$evento->fecha_reunion}}',
					allDay: false,
					backgroundColor: '#A6113C',
					borderColor:'#820F20',
					color:'#ffffff',
					className:'info',
				},
				@endforeach
				@foreach($compromisos as $compromiso)
				{
					title:'{{$compromiso->descripcion}}',
					start: new Date("{{$compromiso->getOriginal()['fecha_limite']}}"),
					hora: '{{$compromiso->fecha_limite}}',
					status: '{{$compromiso->finalizado}}',
					minuta: '{{$compromiso->id_minuta}}',
					allDay: false,
					backgroundColor: '#00CDCD',
					borderColor:'#007D7D',
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
			 $('#moderador').html(event.moderador);
			 $('#secretario').html(event.secretario);
			 $('#eventStart').html(event.hora);
			 $('#fullCalModal').modal();
		 }else{
		 $('#modalTitleC').html(event.title);
		 if(event.status ==1){
		 	$('#modalStatus').html('Finalizado');
		 }else{
			 $('#modalStatus').html('En proceso');
		 }
		 $('#modalMinuta').html(event.minuta);
		 $('#modalResponsabilidad').html(event.status);
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
  },

	});

});

</script>

@stop
