// Variables para los botones de navegación
var indice = 1;
var candado = false;
// Listas de datos a llenar
var formulario = new FormData();

// Arreglo del conteo de asistencias
var asistencia = new Array(convocados_constante+1);
asistencia.fill(false);
// El secretario tiene sistencia de forma obligatoria
asistencia[0] = true;

// Arreglo del conteo de temas pendientes de la orden del dia
var temas_pendientes = new Array(pendientes_constante);
temas_pendientes.fill(false);

// Arreglo que almacenará la descripcion de los hechos de la orden del día
var descripcionHechos = new Array(descripcionHechos_constante);
// Arreglo que almacenará los compromisos con sus responsables
var compromisos = [];
// Arreglo que almacenará las firmas de enterado
var enterados = new Array(convocados_constante+1);
enterados.fill(false);
// Arreglo para agregar la descripcion de los hechos pendientes
var descripcionPendientes = new Array(descripcionHechos_constante);

// Función que se ejecutara cuando se finalice el formulario
function finalizar(){
  inicioSpinner();
  // Se agregan los datos faltantes al formulario y se codifican para el envío
  formulario.append('minuta_constante', JSON.stringify(minuta_constante));
  formulario.append('asistencia', JSON.stringify(asistencia));
  formulario.append('temas_pendientes', JSON.stringify(temas_pendientes));
  formulario.append('descripcionHechos', JSON.stringify(descripcionHechos));
  formulario.append('compromisos', JSON.stringify(compromisos));
  var notas = $('#notas_minuta').val();
  formulario.append('notas', JSON.stringify(notas));
  formulario.append('enterados', JSON.stringify(enterados));
  var fecha_hoy = moment().format("YYYY-MM-DD HH:mm");
  formulario.append('fecha_hoy', JSON.stringify(fecha_hoy));
  formulario.append('descripcionPendientes', JSON.stringify(descripcionPendientes));
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

function firmarMinuta(opcion, boton, indice_asistencia){
  switch (opcion) {
    // Mostrar dialogo para firmar
    case 1:
      var id_convocado = boton.id.split("_");
      var nombre_convocado = $(`#firmas_resumen_convocado_${id_convocado[1]}`).html();
      $('#firmaModalTitulo').html(nombre_convocado);
      $('#btnFirmarMinuta').attr("onClick", `firmar(${id_convocado[1]}, ${indice_asistencia})`);
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

function firmar(id_convocado, indice_asistencia){
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
         enterados[indice_asistencia] = true;
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
  var indice_asistencia = $(boton).parent().attr("data-asistencia");
  if(boton.checked){
    asistencia[indice_asistencia] = true;
    var nombre_convocado = $(`#convocado_resumen_nombre_${id_convocado[2]}`).html();
    $(`#resumen_convocado_asistencia_${id_convocado[2]}`).html("Presente");
    $(`#firmas_resumen`).html($(`#firmas_resumen`).html() + `\
      <tr>\
        <td id="firmas_resumen_convocado_${id_convocado[2]}">${nombre_convocado}</td>\
        <td>\
          <button id="usuario_${id_convocado[2]}" type="button" onClick="firmarMinuta(1, this, ${indice_asistencia});" class="${colorBtn}">Firmar</button>\
        </td>\
      </tr>`);
  } else{
    asistencia[indice_asistencia] = false;
    $(`#resumen_convocado_asistencia_${id_convocado[2]}`).html("Ausente");
    $(`#firmas_resumen_convocado_${id_convocado[2]}`).parent().remove();
  }
}

function actualizarPendientes(boton){
  var id_orden_dia = boton.id.split("_");
  var indice_pendientes = $(boton).attr("data-pendiente");
  if(boton.checked){
    temas_pendientes[indice_pendientes] = true;
    mostrarDialogoPendiente(2, id_orden_dia[2]);
    $(`#orden_pendiente_resumen_${id_orden_dia[2]}`).html("(Tema pendiente)");
  } else{
    temas_pendientes[indice_pendientes] = false;
    descripcionPendientes[indice_pendientes] = null;
    $(`#dh_pendiente_${id_orden_dia[2]}`).html("N/A");
    $(`#orden_pendiente_resumen_${id_orden_dia[2]}`).html("");
    $(`#descripcion_hechos_resumen_pendientes_${id_orden_dia[2]}`).remove();
  }
}

function mostrarDialogoPendiente(opcion, boton){
  var indice_pendientes = $(`#dh_hechos_${boton}`).attr("data-pendiente");
  switch (opcion) {
    // Agregar descripcion del tema pendiente
    case 1:
      var descripcion = $('#hechosDescripcion').val();
      if(descripcion == ""){
        notificacionAjax('bg-red', "El campo no puede estar vacío", 2500,  'bottom', 'center', null, null);
        $(`#pendiente_checkbox_${boton}`).prop('checked', false);
        $(`#dh_pendiente_${boton}`).html("N/A");
        descripcionPendientes[indice_pendientes] = null;
        temas_pendientes[indice_pendientes] = false;
        $(`#orden_pendiente_resumen_${boton}`).html("");
        $(`#descripcion_hechos_resumen_pendientes_${boton}`).remove();
        ocultarHechosDialogo();
        break;
      }
      $(`#dh_pendiente_${boton}`).html(`\
        <button id="pendientes_popover_${boton}" type="button" class="${colorBtn}" data-trigger="focus" data-container="body" data-toggle="popover" data-placement="top" title="Descripción del tema pendiente" data-content="${descripcion}">\
            <i class="material-icons">visibility</i>\
            <span class="hidden-xs">Ver</span>\
        </button>\
        <button id="pendientes_popover_editar_${boton}" type="button" class="btn bg-orange waves-effect" onClick="mostrarDialogoPendiente(3, ${boton})">\
            <i class="material-icons">mode_edit</i>\
            <span class="hidden-xs">Editar</span>\
        </button>\
      `);
      $(`#pendientes_popover_${boton}`).popover();
      $(`#descripcion_hechos_resumen_lista_${boton}`).html($(`#descripcion_hechos_resumen_lista_${boton}`).html() + `\
        <li id="descripcion_hechos_resumen_pendientes_${boton}">Tema pendiente: ${descripcion}</li>
      `);
      descripcionPendientes[indice_pendientes] = descripcion;
      ocultarHechosDialogo();
      break;
    // Mostrar dialogo vacio
    case 2:
      $('#hechosDescripcion').val("");
      $('#btnGuardarhechos').attr("onClick", `mostrarDialogoPendiente(1, ${boton});`);
      $('#btnCancelarhechos').attr("onClick", `mostrarDialogoPendiente(4, ${boton});`);
      $('#hechosModal').modal({
        show:true,
        backdrop:'static'
      });
      break;
    // Mostrar dialogo con campos completos
    case 3:
      var descripcion = $(`#pendientes_popover_${boton}`).attr("data-content");
      $('#hechosDescripcion').val(descripcion);
      $('#btnGuardarhechos').attr("onClick", `mostrarDialogoPendiente(1, ${boton});`);
      $('#btnCancelarhechos').attr("onClick", `mostrarDialogoPendiente(4, ${boton});`);
      $('#hechosModal').modal({
        show:true,
        backdrop:'static'
      });
      break;
    // Limpiar dialogo y cerrarlo
    case 4:
      var descripcionPopover = $(`#pendientes_popover_${boton}`).attr("data-content");
      if(descripcionPopover == null){
        $(`#pendiente_checkbox_${boton}`).prop('checked', false);
        descripcionPendientes[indice_pendientes] = null;
        temas_pendientes[indice_pendientes] = false;
        $(`#orden_pendiente_resumen_${boton}`).html("");
        $(`#descripcion_hechos_resumen_pendientes_${boton}`).remove();
      }
      ocultarHechosDialogo();
      break;
  }
}

function mostrarDialogoHechos(opcion, boton){
  switch(opcion){
    // Agregar nueva descripcion de los hechos
    case 1:
      var descripcion = $('#hechosDescripcion').val();
      if(descripcion == ""){
        notificacionAjax('bg-red', "El campo no puede estar vacío", 2500,  'bottom', 'center', null, null);
        ocultarHechosDialogo();
        break;
      }
      var indice_descripcionHechos = $(`#dh_hechos_${boton}`).attr("data-pendiente");
      descripcionHechos[indice_descripcionHechos] = descripcion;
      $(`#dh_hechos_${boton}`).html(`\
        <button id="hechos_popover_${boton}" type="button" class="${colorBtn}" data-trigger="focus" data-container="body" data-toggle="popover" data-placement="top" title="Descripción de los hechos" data-content="${descripcion}">\
            <i class="material-icons">visibility</i>\
            <span class="hidden-xs">Ver</span>\
        </button>\
        <button id="hechos_popover_editar_${boton}" type="button" class="btn bg-orange waves-effect" onClick="mostrarDialogoHechos(2, ${boton})">\
            <i class="material-icons">mode_edit</i>\
            <span class="hidden-xs">Editar</span>\
        </button>\
      `);
      $(`#descripcion_hechos_resumen_${boton}`).html(descripcion);
      $(`#hechos_popover_${boton}`).popover();
      ocultarHechosDialogo();
      break;
    // Mostrar dialogo para editar descripcion de hechos
    case 2:
      var descripcion = $(`#hechos_popover_${boton}`).attr("data-content");
      $('#hechosDescripcion').val(descripcion);
      $('#btnGuardarhechos').attr("onClick", `mostrarDialogoHechos(1, ${boton});`);
      $('#btnCancelarhechos').attr("onClick", `ocultarHechosDialogo();`);
      $('#btnEliminarHechos').attr("onClick", `mostrarDialogoHechos(4, ${boton});`);
      $('#filaEliminarHechos').show();
      $('#hechosModal').modal({
        show:true,
        backdrop:'static'
      });
      break;
    // Mostrar dialogo vacío
    case 3:
      $('#hechosDescripcion').val("");
      $('#btnGuardarhechos').attr("onClick", `mostrarDialogoHechos(1, "${boton}");`);
      $('#btnCancelarhechos').attr("onClick", `ocultarHechosDialogo();`);
      $('#hechosModal').modal({
        show:true,
        backdrop:'static'
      });
      break;
    // Mostrar dialogo para eliminar descripcion de los hechos
    case 4:
      mensajeAjax('Eliminando', 'Borrando descripción','warning');
      $(`#dh_hechos_${boton}`).html(`\
        <a onClick="mostrarDialogoHechos(3, ${boton});" class="font-bold ${textoColor}"><i class='glyphicon glyphicon-plus'></i> Agregar</a>
      `);
      var indice_descripcionHechos = $(`#dh_hechos_${boton}`).attr("data-pendiente");
      descripcionHechos[indice_descripcionHechos] = null;
      ocultarHechosDialogo();
      break;
  }
}

function ocultarHechosDialogo(){
  $('#hechosModal').modal('hide');
  $('#hechosDescripcion').val("");
  $('#filaEliminarHechos').hide();
  $('#btnEliminarHechos').attr("onClick", "");
  $('#btnGuardarhechos').attr("onClick", "");
  $('#btnCancelarhechos').attr("onClick", "");
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
      var fecha_compromiso = $(`#fecha`).attr("data-fecha");

      $(`#compromisoLista_${id_orden_lista}`).html($(`#compromisoLista_${id_orden_lista}`).html() + `\
        <li id="compromiso_${id_orden_lista}_${id_nuevo}" data-fechaCompromiso="${fecha_compromiso}" data-fechaCompromisoLegible="${fecha_compromiso_legible}"><a onClick="actualizarCompromiso(5, ${id_orden_lista}, ${id_nuevo});" class="col-white label ${fondo}">Compromiso:</a> <span id="descripcion_compromiso_${id_orden_lista}_${id_nuevo}"> ${descripcion_compromiso}</span>\
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

      var compromiso = {
        "id_orden":id_orden_lista,
        "identificador":id_nuevo,
        "descripcion":descripcion_compromiso,
        "fecha":fecha_compromiso,
        "responsables":[id_responsable],
      };
      compromisos.push(compromiso);
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

      for(var i = 0; i < compromisos.length; i++){
        if(compromisos[i].id_orden == id_orden_lista && compromisos[i].identificador == id_nuevo){
          compromisos[i].descripcion = descripcion_compromiso;
          compromisos[i].fecha = fecha_compromiso;
          compromisos[i].responsables[0] = id_responsable;
        }
      }
      limpiarDialogo();
      break;
    // Eliminar compromiso con responsable y los demas responsables
    case 3:
      mensajeAjax('Eliminando', 'Borrando compromiso','warning');
      $(`#compromiso_${id_orden_lista}_${id_nuevo}`).remove();
      $(`#compromiso_resumen_${id_orden_lista}_${id_nuevo}`).remove();
      for(var i = 0; i < compromisos.length; i++){
        if(compromisos[i].id_orden == id_orden_lista && compromisos[i].identificador == id_nuevo){
          compromisos.splice(i, 1);
        }
      }
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
      for(var i = 0; i < compromisos.length; i++){
        if(compromisos[i].id_orden == id_orden_lista && compromisos[i].identificador == id_nuevo){
          for(var j = 0; j < compromisos[i].responsables.length; j++){
            $('#responsable_nuevo_compromiso > option').each(function() {
                if(compromisos[i].responsables[j] == $(this).val() && $(this).val() != id_responsable){
                  $(this).prop("disabled", true);
                }
            });
          }
        }
      }
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
      for(var i = 0; i < compromisos.length; i++){
        if(compromisos[i].id_orden == id_orden_lista && compromisos[i].identificador == id_nuevo){
          compromisos[i].responsables.push(id_responsable);
        }
      }
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

      var id_responsable_antiguo = $(`#responsable_compromiso_texto_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}`).attr("data-id");

      $(`#responsable_compromiso_texto_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}`).html(nombre_responsable);
      $(`#responsable_compromiso_texto_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}`).attr("data-id", id_responsable);
      $(`#responsable_compromiso_resumen_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}`).html(", " + nombre_responsable);

      for(var i = 0; i < compromisos.length; i++){
        if(compromisos[i].id_orden == id_orden_lista && compromisos[i].identificador == id_nuevo){
          for(var j = 0; j < compromisos[i].responsables.length; j++){
            if(compromisos[i].responsables[j] == id_responsable_antiguo){
              compromisos[i].responsables[j] = id_responsable;
            }
          }
        }
      }
      limpiarDialogo();
      break;
    // Eliminar responsable
    case 3:
      var id_responsable = $('#responsable_nuevo_compromiso').val();
      mensajeAjax('Eliminando', 'Quitando responsable','warning');
      $(`#responsable_compromiso_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}`).remove();
      $(`#responsable_compromiso_resumen_${id_orden_lista}_${id_nuevo}_${id_nuevo_responsable}`).remove();
      for(var i = 0; i < compromisos.length; i++){
        if(compromisos[i].id_orden == id_orden_lista && compromisos[i].identificador == id_nuevo){
          for(var j = 0; j < compromisos[i].responsables.length; j++){
            if(compromisos[i].responsables[j] == id_responsable){
              compromisos[i].responsables.splice(j, 1);
            }
          }
        }
      }
      limpiarDialogo();
      break;
    // Mostrar dialogo para nuevo responsable
    case 4:
      var descripcion = $(`#descripcion_compromiso_${id_orden_lista}_${id_nuevo}`).html();
      var fecha_compromiso_legible = $(`#compromiso_${id_orden_lista}_${id_nuevo}`).attr("data-fechaCompromisoLegible");
      $('#compromisoModalTitulo').html("Agregar nuevo responsable");
      $('#descripcion_nuevo_compromiso').val(descripcion);
      $('#descripcion_nuevo_compromiso').prop("disabled", true);
      $('#fecha').prop("disabled", true);
      $('#fecha').val(fecha_compromiso_legible);
      $('#responsable_nuevo_compromiso').prop("disabled", false);
      for(var i = 0; i < compromisos.length; i++){
        if(compromisos[i].id_orden == id_orden_lista && compromisos[i].identificador == id_nuevo){
          for(var j = 0; j < compromisos[i].responsables.length; j++){
            $('#responsable_nuevo_compromiso > option').each(function() {
                if(compromisos[i].responsables[j] == $(this).val()){
                  $(this).prop("disabled", true);
                }
            });
          }
        }
      }
      $(`#responsable_nuevo_compromiso`).selectpicker('refresh');
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
      $('#responsable_nuevo_compromiso').val(id_responsable);
      for(var i = 0; i < compromisos.length; i++){
        if(compromisos[i].id_orden == id_orden_lista && compromisos[i].identificador == id_nuevo){
          for(var j = 0; j < compromisos[i].responsables.length; j++){
            $('#responsable_nuevo_compromiso > option').each(function() {
                if(compromisos[i].responsables[j] == $(this).val() && $(this).val() != id_responsable){
                  $(this).prop("disabled", true);
                }
            });
          }
        }
      }
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
  $('#responsable_nuevo_compromiso > option').each(function() {
      $(this).prop("disabled", false);
  });
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
      var fecha = date.format("YYYY-MM-DD HH:mm");

      $('#fecha').attr("data-fecha", fecha);
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
