var indice = 1;
var candado = false;
// Listas de datos a llenar
var formulario = new FormData();

var asistencia = [];
var temas_pendientes =[];


// Función que se ejecutara cuando se finalice el formulario
function finalizar(){
  inicioSpinner();
  // Se agregan los datos faltantes al formulario y se codifican para el envío
  formulario.append('convocados', JSON.stringify(convocados));
  formulario.append('roles', JSON.stringify(roles));
  formulario.append('orden_dia', JSON.stringify(orden_dia));
  formulario.append('responsables', JSON.stringify(responsables));
  // Se hace la petición al servidor
  $.ajax({
     type:'POST',
     url: url,
     data:formulario,
     processData:false,
     contentType:false,
     success:function(result){
       if(result.errores){
         finSpinner();
         mensajeAjax('Error', 'Verifique sus datos', 'error');
         var errores = '<ul>';
         $.each(result.errores,function(indice,valor){
           errores += '<li>' + valor + '</li>';
         });
         errores += '</ul>';
         notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
       } else{
         mensajeAjax('Registro correcto', result.mensaje,'success');
         window.setTimeout(function(){
           location.href = urlToRedirectPage;
         } ,1500);
       }
      },
      error: function (jqXHR, status, error) {
        finSpinner();
        mensajeAjax('Error', error, 'error');
      }
  });
}

function firmarMinuta(opcion, boton){
  switch (opcion) {
    // Mostrar dialogo para firmar
    case 1:
      var id_convocado = boton.id.split("_");
      var nombre_convocado = $(`#firmas_resumen_convocado_${id_convocado[1]}`).html();
      $('#firmaModalTitulo').html(nombre_convocado);
      $('#btnFirmarMinuta').attr("onClick", `firmar(${id_convocado[1]})`);
      $('#firmaModal').modal('show');
      break;
    // Ocultar dialogo para firmar
    case 2:
      $('#firmaModalTitulo').html("");
      $('#clave_firma').val("");
      $('#firmaModal').modal('hide');
      break;
  }
}

function firmar(id_convocado){
  var clave = $('#clave_firma').val();
  $.ajax({
     type:'POST',
     url: urlEnterado,
     data:
     {
       "clave":clave,
       "id_convocado": id_convocado
     },
     success:function(result){
       if(result.errores){
         var errores = '<ul>';
         $.each(result.errores,function(indice,valor){
           errores += '<li>' + valor + '</li>';
         });
         errores += '</ul>';
         notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
       } else{
         mensajeAjax('Registro correcto', result.mensaje,'success');
         $(`#usuario_${id_convocado}`).parent().html('<i class="material-icons">done</i>');
       }
    },
    error: function (jqXHR, status, error) {
     mensajeAjax('Error', error, 'error');
    }
  });
  firmarMinuta(2);
}

function actualizarAsistencia(boton){
  var id_convocado = boton.id.split("_");
  if(boton.checked){
    asistencia.push(boton.id);
    var nombre_convocado = $(`#convocado_resumen_nombre_${id_convocado[2]}`).html();
    $(`#resumen_convocado_asistencia_${id_convocado[2]}`).html("Presente");
    $(`#firmas_resumen`).html($(`#firmas_resumen`).html() + `\
      <tr>\
        <td id="firmas_resumen_convocado_${id_convocado[2]}">${nombre_convocado}</td>\
        <td>\
          <button id="usuario_${id_convocado[2]}" type="button" onClick="firmarMinuta(1, this);" class="${colorBtn}">Firmar</button>\
        </td>\
      </tr>`);
  } else{
    var indice = asistencia.indexOf(boton.id);
    if(indice!=-1){
       asistencia.splice(indice, 1);
    }
    $(`#resumen_convocado_asistencia_${id_convocado[2]}`).html("Ausente");
    $(`#firmas_resumen_convocado_${id_convocado[2]}`).parent().remove();
  }
}

function actualizarPendientes(boton){
  var id_orden_dia = boton.id.split("_");
  if(boton.checked){
    temas_pendientes.push(boton.id);
    $(`#orden_pendiente_resumen_${id_orden_dia[2]}`).html("(Tema pendiente)");
  } else{
    var indice = asistencia.indexOf(boton.id);
    if(indice!=-1){
       asistencia.splice(indice, 1);
    }
    $(`#orden_pendiente_resumen_${id_orden_dia[2]}`).html("");
  }
}

function mostrarDialogoHechos(opcion, th){
  switch(opcion){
    // Agregar nueva descripcion de los hechos
    case 1:
      var descripcion = $('#hechosDescripcion').val();
      $(`#${th}`).html(descripcion);
      $(`#${th}`).attr("onClick", `mostrarDialogoHechos(4, "${th}");`);
      $(`#descripcion_hechos_resumen_${th}`).html(descripcion);
      ocultarHechosDialogo();
      break;
    // Mostrar dialogo para eliminar descripcion de hechos
    case 2:
      $(`#${th}`).html("Ingrese la descripcion de lo hechos.");
      $(`#descripcion_hechos_resumen_${th}`).html("Ingrese la descripcion de lo hechos.");
      ocultarHechosDialogo();
      break;
    // Mostrar dialogo vacío
    case 3:
      $('#hechosDescripcion').val("");
      $('#btnGuardarhechos').attr("onClick", `mostrarDialogoHechos(1, "${th.id}");`);
      $('#hechosModal').modal('show');
      break;
    // Mostrar dialogo para editar descripcion de los hechos
    case 4:
      var descripcion = $(`#${th}`).html();
      $('#hechosDescripcion').val(descripcion);
      $('#btnGuardarhechos').attr("onClick", `mostrarDialogoHechos(1, "${th}");`);
      $('#filaEliminarHechos').show();
      $('#btnEliminarHechos').attr("onClick", `mostrarDialogoHechos(2, "${th}");`);
      $('#hechosModal').modal('show');
      break;
  }
}

function ocultarHechosDialogo(){
  $('#hechosModal').modal('hide');
  $('#hechosDescripcion').val("");
  $('#filaEliminarHechos').hide();
  $('#btnEliminarHechos').attr("onClick", "");
}

function actualizarCompromiso(opcion, id_orden_lista, id_nuevo){
  switch(opcion){
    // Agregar compromiso
    case 1:
      var descripcion_compromiso = $('#descripcion_nuevo_compromiso').val();
      var id_responsable = $('#responsable_nuevo_compromiso').val();
      var nombre_responsable = $('#responsable_nuevo_compromiso option:selected').html();

      if(id_responsable == 0 || descripcion_compromiso == ""){
        notificacionAjax('bg-red', "Los campos no pueden estar vacíos", 2500,  'bottom', 'center', null, null);
        limpiarDialogo();
        break;
      }

      var id_nuevo = Math.floor(Math.random() * 9999);
      var numero_indice = $(`#descripcion_orden_resumen_${id_orden_lista}`).attr("data-numero");
      var fecha_compromiso_legible = $(`#fecha`).attr("data-fechaLegible");
      var fecha_compromiso = $(`#fecha`).attr("data-fecha"); ///////////////////agregar a formulario

      $(`#compromisoLista_${id_orden_lista}`).html($(`#compromisoLista_${id_orden_lista}`).html() + `\
        <li id="compromiso_${id_orden_lista}_${id_nuevo}" data-fechaCompromiso="${fecha_compromiso}" data-fechaCompromisoLegible="${fecha_compromiso_legible}"><a onClick="actualizarCompromiso(5, ${id_orden_lista}, ${id_nuevo});" class="col-white label ${fondo}">Compromiso:</a><span id="descripcion_compromiso_${id_orden_lista}_${id_nuevo}"> ${descripcion_compromiso}</span>\
          <ul id="lista_responsables_compromiso_${id_orden_lista}_${id_nuevo}">\
            <li><a onClick="actualizarResponsable(4, ${id_orden_lista}, ${id_nuevo});" class="font-bold ${textoColor}"><i class='tree-indicator glyphicon glyphicon-plus'></i>Agregar nuevo responsable</a></li>\
            <li><span class="font-bold ${textoColor}"><i class='tree-indicator glyphicon glyphicon-user'></i>Responsable: </span><span id="responsable_compromiso_texto_${id_orden_lista}_${id_nuevo}_${id_orden_lista}" data-id="${id_responsable}">${nombre_responsable}</span></li>\
          </ul>\
        </li>`);

      $("#tabla_compromisos_resumen").html($("#tabla_compromisos_resumen").html() + `\
        <tr id="compromiso_resumen_${id_orden_lista}_${id_nuevo}">\
          <td>${numero_indice}</td>\
          <td id="descripcion_compromiso_resumen_${id_orden_lista}_${id_nuevo}">${descripcion_compromiso}</td>\
          <td id="responsable_compromiso_texto_resumen_${id_orden_lista}_${id_nuevo}_${id_orden_lista}">${nombre_responsable}</td>\
          <td id="fecha_compromiso_${id_orden_lista}">${fecha_compromiso_legible}</td>\
        </tr>`);
      limpiarDialogo();
      break;
    // Editar compromiso y principal responsable
    case 2:
      var descripcion_compromiso = $('#descripcion_nuevo_compromiso').val();
      var id_responsable = $('#responsable_nuevo_compromiso').val();
      var nombre_responsable = $('#responsable_nuevo_compromiso option:selected').html();

      if(id_responsable == 0 || descripcion_compromiso == ""){
        notificacionAjax('bg-red', "Los campos no pueden estar vacíos", 2500,  'bottom', 'center', null, null);
        limpiarDialogo();
        break;
      }

      var fecha_compromiso_legible = $(`#fecha`).attr("data-fechaLegible");
      var fecha_compromiso = $(`#fecha`).attr("data-fecha"); ///////////////////agregar a formulario

      $(`#descripcion_compromiso_${id_orden_lista}_${id_nuevo}`).html(descripcion_compromiso);
      $(`#responsable_compromiso_texto_${id_orden_lista}_${id_nuevo}_${id_orden_lista}`).html(nombre_responsable);
      $(`#responsable_compromiso_texto_${id_orden_lista}_${id_nuevo}_${id_orden_lista}`).attr("data-id", id_responsable);
      $(`#compromiso_${id_orden_lista}_${id_nuevo}`).attr("data-fechaCompromiso", `${fecha_compromiso}`);
      $(`#compromiso_${id_orden_lista}_${id_nuevo}`).attr("data-fechaCompromisoLegible", `${fecha_compromiso_legible}`);

      $(`#descripcion_compromiso_resumen_${id_orden_lista}_${id_nuevo}`).html(descripcion_compromiso);
      $(`#responsable_compromiso_texto_resumen_${id_orden_lista}_${id_nuevo}_${id_orden_lista}`).html(nombre_responsable);
      $(`#fecha_compromiso_${id_orden_lista}`).html(fecha_compromiso_legible);
      limpiarDialogo();
      break;
    // Eliminar compromiso con responsable y los demas responsables
    case 3:
      mensajeAjax('Eliminando', 'Borrando compromiso','warning');
      $(`#compromiso_${id_orden_lista}_${id_nuevo}`).remove();
      $(`#compromiso_resumen_${id_orden_lista}_${id_nuevo}`).remove();
      limpiarDialogo();
      break;
    // Mostrar dialogo con compromiso al presionar "Agregar nuevo compromiso"
    case 4:
      $('#compromisoModalTitulo').html("Agregar nuevo compromiso");
      $('#descripcion_nuevo_compromiso').prop("disabled", false);
      $('#responsable_nuevo_compromiso').prop("disabled", false);
      $(`#responsable_nuevo_compromiso`).selectpicker('refresh');
      $('#btnGuardar').attr("onClick", `actualizarCompromiso(1, ${id_orden_lista});`);
      // Campo de fecha
      $('#fecha').prop("disabled", false);
      $('#compromisoModal').modal('show');
      break;
    // Mostrar dialogo con campos poblados para editar compromiso
    case 5:
      var descripcion_compromiso = $(`#descripcion_compromiso_${id_orden_lista}_${id_nuevo}`).html();
      var id_responsable = $(`#responsable_compromiso_texto_${id_orden_lista}_${id_nuevo}_${id_orden_lista}`).attr("data-id");
      var fecha_compromiso = $(`#compromiso_${id_orden_lista}_${id_nuevo}`).attr("data-fechaCompromiso");
      var fecha_compromiso_legible = $(`#compromiso_${id_orden_lista}_${id_nuevo}`).attr("data-fechaCompromisoLegible");

      $('#compromisoModalTitulo').html("Editar compromiso");
      // Campo de descripcion del dialogo
      $('#descripcion_nuevo_compromiso').prop("disabled", false);
      $('#descripcion_nuevo_compromiso').val(descripcion_compromiso);
      // Campo de seleccion de responsable
      $('#responsable_nuevo_compromiso').prop("disabled", false);
      $(`#responsable_nuevo_compromiso`).val(id_responsable);
      $(`#responsable_nuevo_compromiso`).selectpicker('refresh');
      // Campo de fecha
      $('#fecha').prop("disabled", false);

      $('#filaEliminar').show();
      $('#btnEliminar').attr("onClick", `actualizarCompromiso(3, ${id_orden_lista}, ${id_nuevo});`);
      $('#btnGuardar').attr("onClick", `actualizarCompromiso(2, ${id_orden_lista}, ${id_nuevo});`);
      $('#fecha').attr("data-fecha", fecha_compromiso);
      $('#fecha').attr("data-fechaLegible", fecha_compromiso_legible);
      $('#fecha').val(fecha_compromiso_legible);
      $('#compromisoModal').modal('show');
      break;
  }
}

function actualizarResponsable(opcion, id_orden_lista, id_nuevo, id_nuevo_responsable){
  switch(opcion){
    // Agregar responsable
    case 1:
      var id_responsable = $('#responsable_nuevo_compromiso').val();
      var nombre_responsable = $('#responsable_nuevo_compromiso option:selected').html();

      if(id_responsable == 0){
        notificacionAjax('bg-red', "El campo no puede estar vacío", 2500,  'bottom', 'center', null, null);
        limpiarDialogo();
        break;
      }

      var id_nuevo_responsable = Math.floor(Math.random() * 9999);

      $(`#lista_responsables_compromiso_${id_orden_lista}_${id_nuevo}`).html($(`#lista_responsables_compromiso_${id_orden_lista}_${id_nuevo}`).html() + `\
        <li id="responsable_compromiso_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}"><a onClick="actualizarResponsable(5, ${id_orden_lista}, ${id_nuevo}, ${id_nuevo_responsable});" class="font-bold ${textoColor}"><i class='tree-indicator glyphicon glyphicon-user'></i>Responsable: </a><span id="responsable_compromiso_texto_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}" data-id="${id_responsable}">${nombre_responsable}</span></li>\
      `);

      $(`#responsable_compromiso_texto_resumen_${id_orden_lista}_${id_nuevo}_${id_orden_lista}`).html($(`#responsable_compromiso_texto_resumen_${id_orden_lista}_${id_nuevo}_${id_orden_lista}`).html() + `\
        <span id="responsable_compromiso_resumen_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}">, ${nombre_responsable}</span>`);
      limpiarDialogo();
      break;
    // Editar responsable
    case 2:
      var id_responsable = $('#responsable_nuevo_compromiso').val();
      var nombre_responsable = $('#responsable_nuevo_compromiso option:selected').html();

      if(id_responsable == 0){
        notificacionAjax('bg-red', "El campo no puede estar vacío", 2500,  'bottom', 'center', null, null);
        limpiarDialogo();
        break;
      }

      $(`#responsable_compromiso_texto_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}`).html(nombre_responsable);
      $(`#responsable_compromiso_texto_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}`).attr("data-id", id_responsable);
      $(`#responsable_compromiso_resumen_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}`).html(", " + nombre_responsable);
      limpiarDialogo();
      break;
    // Eliminar responsable
    case 3:
      mensajeAjax('Eliminando', 'Quitando responsable','warning');
      $(`#responsable_compromiso_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}`).remove();
      $(`#responsable_compromiso_resumen_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}`).remove();
      limpiarDialogo();
      break;
    // Mostrar dialogo para nuevo responsable
    case 4:
      var descripcion = $(`#descripcion_compromiso_${id_orden_lista}_${id_nuevo}`).html();
      var fecha_compromiso_legible = $(`#compromiso_${id_orden_lista}_${id_nuevo}`).attr("data-fechaCompromisoLegible");
      $('#compromisoModalTitulo').html("Agregar nuevo responsable");
      $('#descripcion_nuevo_compromiso').val(descripcion);
      $('#descripcion_nuevo_compromiso').prop("disabled", true);
      $('#responsable_nuevo_compromiso').prop("disabled", false);
      $(`#responsable_nuevo_compromiso`).selectpicker('refresh');
      $('#fecha').prop("disabled", true);
      $('#fecha').val(fecha_compromiso_legible);

      $('#btnGuardar').attr("onClick", `actualizarResponsable(1, ${id_orden_lista}, ${id_nuevo});`);
      $('#compromisoModal').modal('show');
      break;
    // Mostrar dialogo para editar responsable
    case 5:
      var descripcion = $(`#descripcion_compromiso_${id_orden_lista}_${id_nuevo}`).html();
      var id_responsable = $(`#responsable_compromiso_texto_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}`).attr("data-id");
      var fecha_compromiso_legible = $(`#compromiso_${id_orden_lista}_${id_nuevo}`).attr("data-fechaCompromisoLegible");
      $('#compromisoModalTitulo').html("Editar responsable del compromiso");
      $('#descripcion_nuevo_compromiso').val(descripcion);
      $('#descripcion_nuevo_compromiso').prop("disabled", true);
      $('#responsable_nuevo_compromiso').prop("disabled", false);
      $('#responsable_nuevo_compromiso').val(id_responsable)
      $(`#responsable_nuevo_compromiso`).selectpicker('refresh');
      $('#fecha').prop("disabled", true);
      $('#fecha').val(fecha_compromiso_legible);
      $('#filaEliminar').show();
      $('#btnEliminar').attr("onClick", `actualizarResponsable(3, ${id_orden_lista}, ${id_nuevo}, ${id_nuevo_responsable});`);
      $('#btnGuardar').attr("onClick", `actualizarResponsable(2, ${id_orden_lista}, ${id_nuevo}, ${id_nuevo_responsable});`);
      $('#compromisoModal').modal('show');
      break;
  }
}

function limpiarDialogo(){
  $('#compromisoModal').modal('hide');
  $('#compromisoModalTitulo').html("");
  $('#filaEliminar').hide();
  $('#btnEliminar').attr("onClick", "");
  $('#descripcion_nuevo_compromiso').val("");
  $('#descripcion_nuevo_compromiso').prop("disabled", true);
  $('#responsable_nuevo_compromiso').val(0);
  $('#responsable_nuevo_compromiso').prop("disabled", true);
  $('#responsable_nuevo_compromiso').selectpicker('refresh');
  $('#fecha').val(null);
  $('#fecha').prop("disabled", true);
}

// Botones de navegación
function cancelar(){
  mensajeAjax('Registro cancelado', 'Redireccionando a inicio','warning');
  window.setTimeout(function(){
    location.href = urlToCancelPage;
  } ,1500);
}

function anterior(){
  if(indice > 1){
    var menu = "#menu"+indice;
    var paso2 = "#paso"+indice;

    $(menu).hide();
    indice--;
    var paso = "#paso"+indice;

    $(paso2).addClass(fondo);
    $(paso2).removeClass("bg-pink");
    $(paso).addClass("bg-pink");
    $(paso).removeClass("bg-grey");
    menu = "#menu"+indice;
    $(menu).show(200);

    $('#siguiente').html('Siguiente');
    candado = false;
    if(indice == 1){
      $('#anterior').removeClass(colorBtn);
      $('#anterior').addClass(colorBtnDis);
      $('#anterior').prop( "disabled", true );
    }
  }
}

function siguiente(){
  if(indice < 5){
    var menu = "#menu"+indice;
    var paso = "#paso"+indice;
    var indice2 = indice+1;
    var paso2 = "#paso"+indice2;
    $(menu).hide();
    $(paso).addClass("bg-grey");
    $(paso).removeClass("bg-pink");
    $(paso2).addClass("bg-pink");
    $(paso2).removeClass(fondo);
    indice++;
    menu = "#menu"+indice;
    $(menu).show(200);
    if(indice == 5){
      $('#siguiente').html('Finalizar');
      candado = true;
    }
    if(indice > 1){
      $('#anterior').removeClass(colorBtnDis);
      $('#anterior').addClass(colorBtn);
      $('#anterior').prop( "disabled", false );
    }
  } else{
    if(candado == true){
      finalizar();
    }
  }
}

// Función al recargar la página, cambia estilos e inicaliza scripts en español
$(function () {
    // Cambia estilos
    // Cuerpo
    $('body').removeClass('theme-pink');
    $('body').addClass(tema);
    // Botones
    $('.colorBoton').addClass(colorBtn);
    $('.colorBotonDis').addClass(colorBtnDis);
    $('#anterior').prop( "disabled", true );
    // Checkboxs
    $('.chk-col-teal').addClass(colorCheck);
    $('.chk-col-teal').removeClass('chk-col-teal');
    // Fondos generales y objetos ocultos
    $('.fondo').addClass(fondo);
    $('.oculto').hide();
    //texto
    $('.texto').addClass(textoColor);

    //Datetimepicker plugin
    moment.updateLocale('en', {
      months : [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
      ],
      monthsShort : [
      "Ene", "Feb", "Mar", "Abr", "May", "Jun",
      "Jul", "Ago", "Sep", "Oct", "Nov", "Dec"
      ],
      weekdays : [
        "Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"
      ],
      weekdaysShort : ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
      weekdaysMin : ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
    });
    $('#fecha_hoy').html(moment().format("dddd DD MMMM YYYY [a las] HH:mm [hrs]"));
    $('.datetimepicker').bootstrapMaterialDatePicker({
        cancelText : 'Cancelar',
        clearText : 'Limpiar',
        okText : 'Siguiente',
        nowText : 'Hoy',
        format: 'dddd DD MMMM YYYY [a las] HH:mm [hrs]',
        clearButton: false,
        nowButton: true,
        weekStart: 1,
        minDate : new Date(),
    }).on('change', function(e, date){
      // Función que se ejecuta al agregar fecha
      // Si la fecha es anterior a hoy
      if(moment(date).isBefore(moment())){
        mensajeAjax('Error', 'La fecha tiene que estar en futuro.','error');
        $('#fecha').val(null);
        return false;
      }
      // Ponemos los datos en formato amigable y agregamos los datos al formulario que se va a envíar
      var fecha_legible = date.format("dddd DD MMMM YYYY [a las] HH:mm [hrs]");

      $('#fecha').attr("data-fecha", date);
      $('#fecha').attr("data-fechaLegible", fecha_legible);
  	});

    // Data table plugin
    $('.js-basic-example').DataTable({
        responsive: true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No encontrado - lo siento",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Se filtró de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate": {
                "previous": "<",
                "next": ">"
              }
        },
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "Todos"]],
        "autoWidth": false,
    });

    $('#icono').animateCss('bounceIn');

   $('.treeview').each(function () {
  		var tree = $(this);
  		tree.treeview();
  	});
});


//Copied from https://github.com/daneden/animate.css
$.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $(this).addClass('vendor-animation-duration: 3s; -vendor-animation-delay: 2s; -moz-animation-iteration-count: infinite;');
        $(this).addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
});
