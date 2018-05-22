var indice = 1;
var candado = false;
// Listas de datos a llenar
var formulario = new FormData();
// Se agrega al usuario logueado a la nueva lista
var convocados = [];
convocados.push(moderador);
var puestos = [1];

var orden_dia = [];
var responsables = [];
// Control del la orden del día y sus responsables
var orden_dia_control = [];
// Arreglos de los temas pendientes (Una vez creada la nueva convocatoria ya no seran pendientes)
var pendientes = [];

// Función que se ejecutara cuando se finalice el formulario
function finalizar(){
  inicioSpinner();
  // Se agregan los datos faltantes al formulario y se codifican para el envío
  formulario.append('convocados', JSON.stringify(convocados));
  formulario.append('puestos', JSON.stringify(puestos));
  formulario.append('orden_dia', JSON.stringify(orden_dia));
  formulario.append('responsables', JSON.stringify(responsables));
  formulario.append('pendientes', JSON.stringify(pendientes));
  formulario.append('secretario', JSON.stringify(secretario));
  formulario.append('moderador', JSON.stringify(moderador));
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

// Función que se ejecuta al seleccionar un rol para el usuario
function actualizarPuesto(id){
  var id_puesto = $(`#puesto_seleccion_${id} option:selected`).val();
  var descripcion_puesto = $(`#puesto_seleccion_${id} option:selected`).html();
  // Cambia el id del rol dentro de la lista de registros creada a la hora de palomear un usuario
  var indice = convocados.indexOf(id);
  puestos[indice] = id_puesto;

  $(`#puesto_resumen_${id}`).html(descripcion_puesto);
}

// Función que se ejecuta al palomear un usuario
function actualizarLista(id){
  $(`#puesto_seleccion_${id}`).selectpicker();
  // Checa si esta palomeado el usuario
  var boton = $(`#md_checkbox_${id}`);
  if(boton.prop('checked')){
    var nombre = $(`#nombre_convocado_tabla_${id}`).html();
    var descripcion_puesto = $(`#puesto_seleccion_${id} option:eq(0)`).html();
    var id_puesto = $(`#puesto_seleccion_${id} option:eq(0)`).val();

    convocados.push(id);
    puestos.push(id_puesto);
    // Muestra el boton de rol y hace cambios en el resumen
    $(`#area_puesto_${id}`).show();
    $('#lista_convocados_resumen').html($('#lista_convocados_resumen').html() + `\
      <tr id="nombre_texto_${id}">\
        <td>${nombre}</td>\
        <td id="puesto_resumen_${id}">${descripcion_puesto}</td>\
        <td id="rol_resumen_${id}">Convocado</td>\
      </tr>`);
    $('#responsable_nuevo_tema').html($('#responsable_nuevo_tema').html() + `\
      <option id="convocado_opcion_${id}" value="${id}">${nombre}</option>`);
  } else{
    // Elimina a el usuario de la lista si existe
    var indice = convocados.indexOf(id);
    if(indice!=-1){
       convocados.splice(indice, 1);
       puestos.splice(indice, 1);
    }
    // Oculta el boton de rol y actualiza el resumen de la página
    $(`#area_puesto_${id}`).hide();
    $(`#nombre_texto_${id}`).remove();
    $(`#convocado_opcion_${id}`).remove();
    $(`#puesto_seleccion_${id}`).val(0);
    $(`#puesto_seleccion_${id}`).selectpicker('refresh');
  }
  $(`#responsable_nuevo_tema`).selectpicker('refresh');
}

// Función que se ejecuta al agregar o editar una orden del día (Boton es un numero aleatorio)
function actualizarOrdenDia(opc, boton){
  switch(opc){
    // Guardar nuevo tema de orden del dia
    case 1:
      var descripcion = $('#descripcion_nuevo_tema').val();
      var seleccion = $('#responsable_nuevo_tema').val();
      var nombres = $('#responsable_nuevo_tema option:selected').html();
      var nombre = nombres.split(" ");
      // checa si el campo de descripcion esta vacio
      if(descripcion == ""){
        $('#temasModal').modal('hide');
        notificacionAjax('bg-red', "Los campos no pueden estar vacíos", 2500,  'bottom', 'center', null, null);
        break;
      }
      // genera un numero aleatorio con el cual identificar y poder cambiar los datos en la pagina html
      var idRand = Math.floor(Math.random() * 99);
      var lista_texto_id = 'ordenDia_texto' + idRand;
      var boton_id = 'ordenDia' + idRand;
      // Se agregan los datos corresponientes a las listas
      orden_dia.push(descripcion);
      responsables.push(seleccion);
      orden_dia_control.push(idRand);
      // Se genera el codigo HTML correspondiente de los botones
      $('#lista_orden').html($('#lista_orden').html() + `\
      <button id="${boton_id}" type="button" onClick="actualizarOrdenDia(3, ${idRand});" class="list-group-item tooltips" \
      style="word-wrap: break-word;" data-usuario="${seleccion}" data-toggle="tooltip" data-placement="top" title="Responsable: ${nombres}" data-container="body" data-trigger="hover">${descripcion}</button>`);
      $(`#${boton_id}`).tooltip();
      $('#lista_texto').html($('#lista_texto').html() + `\
        <li id="${lista_texto_id}">${descripcion} => ${nombre[0]} ${nombre[1]}</li>`);
      ocultarDialogo();
      break;
    // editar tema existente
    case 2:
      var descripcion = $('#descripcion_nuevo_tema').val();
      var seleccion = $('#responsable_nuevo_tema').val();
      var nombres = $('#responsable_nuevo_tema option:selected').html();
      var nombre = nombres.split(" ");
      // checa si el campo de descripcion esta vacio
      if(descripcion == ""){
        $('#temasModal').modal('hide');
        $('#filaEliminar').hide();
        $('#btnGuardar').attr("onClick",`actualizarOrdenDia(1, null);`);
        $('#btnEliminar').attr("onClick",`actualizarOrdenDia(1, null);`);
        notificacionAjax('bg-red', "Los campos no pueden estar vacíos", 2500,  'bottom', 'center', null, null);
        break;
      }
      // Cambia los valores en el indice de los temas correspondientes
      var indice = orden_dia_control.indexOf(boton);
      if(indice!=-1){
         orden_dia[indice] = descripcion;
         responsables[indice] = seleccion;
      }
      // limpia los campos, los datos y hace los cambios
      $(`#ordenDia${boton}`).html(descripcion);
      $(`#ordenDia${boton}`).attr('data-original-title', 'Responsable: ' + nombres);
      $(`#ordenDia${boton}`).tooltip();
      $(`#ordenDia${boton}`).attr("data-usuario", `${seleccion}`);
      $(`#ordenDia_texto${boton}`).html(descripcion + " => " + nombre[0] + " " + nombre[1]);

      ocultarDialogo();
      break;
    // mostrar dialogo con campos
    case 3:
      var descripcion = $(`#ordenDia${boton}`).html();
      var opcion = $(`#ordenDia${boton}`).attr("data-usuario");
      $('#descripcion_nuevo_tema').val(descripcion);
      $('#responsable_nuevo_tema').val(opcion);
      $(`#responsable_nuevo_tema`).selectpicker('refresh');
      // cambia la accion de guardar en el modal dialog para que se pueda editar un campo
      $('#btnGuardar').attr("onClick",`actualizarOrdenDia(2, ${boton});`);
      $('#btnEliminar').attr("onClick",`actualizarOrdenDia(6, ${boton});`);
      $('#titulo_modal_convocados').html("Editar tema para la reunión");
      $('#filaEliminar').show();
      $('#convocadosModal').modal('show');
      break;
    // mostrar dialogo vacío
    case 4:
      $('#titulo_modal_convocados').html("Nuevo tema para la reunión");
      $('#btnGuardar').attr("onClick",`actualizarOrdenDia(1);`);
      $('#convocadosModal').modal('show');
      break;
    // boton de cancelar
    case 5:
      ocultarDialogo();
      break;
    // boton de eliminar registro
    case 6:
      mensajeAjax('Eliminando', 'Borrando registro','warning');
      $(`#ordenDia_texto${boton}`).remove();
      $(`#ordenDia${boton}`).tooltip('destroy');
      $(`#ordenDia${boton}`).remove();
      // Busca el valor en un indice y lo elimina de la lista
      var indice = convocados.indexOf(boton);
      if(indice!=-1){
         orden_dia.splice(indice, 1);
         responsables.splice(indice, 1);
         orden_dia_control.splice(indice, 1);
      }
      // Pone los valores en vacío
      ocultarDialogo();
      break;
  }
}

function actualizarSecretario(opc){
  switch (opc) {
    // Actualizar secretario de la reunion
    case 1:
      var id_usuario = $('#responsable_nuevo_tema').val();
      if(moderador == id_usuario){
        $(`#rol_resumen_${id_usuario}`).html("Moderador y secretario");
        $(`#rol_resumen_${secretario}`).html("Convocado");
      } else if(secretario == moderador){
        $(`#rol_resumen_${secretario}`).html("Moderador");
        $(`#rol_resumen_${id_usuario}`).html("Secretario");
      } else{
        $(`#rol_resumen_${secretario}`).html("Convocado");
        $(`#rol_resumen_${id_usuario}`).html("Secretario");
      }
      secretario = id_usuario;
      ocultarDialogo();
      break;
    // Mostrar dialogo para actualizar secretario
    case 2:
      $('#responsable_nuevo_tema').val(secretario);
      $(`#responsable_nuevo_tema`).selectpicker('refresh');
      $('#titulo_modal_convocados').html("Actualizar secretario de la reunión");
      $('#cuerpo_descripcion').hide();
      $('#btnGuardar').attr("onClick", 'actualizarSecretario(1);');
      $('#convocadosModal').modal('show');
      break;
  }
}

function ocultarDialogo(){
  $('#convocadosModal').modal('hide');
  $('#descripcion_nuevo_tema').val(null);
  $('#responsable_nuevo_tema').val(0);
  $(`#responsable_nuevo_tema`).selectpicker('refresh');
  $('#filaEliminar').hide();
  $('#btnGuardar').attr("onClick",'');
  $('#btnEliminar').attr("onClick",'');
  $('#titulo_modal_convocados').html("");
  $('#cuerpo_descripcion').show();
}

// Función que se ejecuta al escribir el motivo
function actualizarMotivo(valor){
  var motivo = valor.value;
  $('#motivo_texto').html(motivo);
  formulario.set('motivo', motivo);
}

// Función que se ejecuta al escribir el lugar
function actualizarLugar(valor){
  var lugar = valor.value;
  $('#lugar_texto').html(lugar);
  formulario.set('lugar', lugar);
}

// Función que se ejecuta cuando se selecciona un tipo de reunión
function actualizarTipo(opcion){
  var id_tipo_reunion = opcion.value;
  var descripcion = $("#tipo_reunion option:selected").html();
  var imagen = $("#tipo_reunion option:selected").attr("data-imagen");
  // En caso de que no seleccione una
  if(id_tipo_reunion == 0){
    return false;
  }
  // Se cambia el contenido de la pagina por los datos de el ripo de reunión seleccionada
  $('#tipo_texto').html('"' + descripcion + '"');
  $('#imagen_tipo_reunion').attr("src", imagen);
  $('#imagen_tipo_reunion_texto').attr("src", imagen);

  formulario.set('tipo_de_reunion', id_tipo_reunion);
  var url = urlToCancelPage + "reunion_especifica";
  // Se sacan los datos del servidor
  var formdata = new FormData();
  formdata.append('id', id_tipo_reunion);

  $.ajax({
     type:'POST',
     url: url,
     data:formdata,
     processData:false,
     contentType:false,
     success:function(result){
       if(result.errores){
         notificacionAjax('bg-red', result.errores, 2500,  'bottom', 'center', null, null);
       } else{
         // En caso de tener una buena respuesta se hacen los cambios
         $('#lista_pendientes').html('');
         if(result.datos.length > 0){
           for(var i = 0; i < result.datos.length; i++){
             var nombre_usuario = $(`#nombre_convocado_tabla_${result.datos[i]['id_usuario']}`).html();
             $('#lista_pendientes').html($('#lista_pendientes').html() + `\
             <button id="pendiente_${result.datos[i]['id_tema_pendiente']}" type="button" onClick="agregarTemaPendiente(${result.datos[i]['id_tema_pendiente']}, '${result.datos[i]['descripcion']}');" class="list-group-item tooltips" \
             style="word-wrap: break-word;" data-usuario="" data-toggle="tooltip" data-placement="top" title="Responsable: ${nombre_usuario}" data-container="body" data-trigger="hover">${result.datos[i]['descripcion']}</button>`);
           }
           $('.tooltips').tooltip();
         } else{
           notificacionAjax('bg-blue-grey',result.mensaje, 2500,  'bottom', 'center', null, null);
         }
       }
    },
    error: function (jqXHR, status, error) {
     mensajeAjax('Error', error, 'error');
    }
  });
}
// Al hacer click sobre el tema pendiente
function agregarTemaPendiente(id_tema, descripcion){
  var idRand = Math.floor(Math.random() * 99);
  var lista_texto_id = 'ordenDia_texto' + idRand;
  var boton_id = 'ordenDia' + idRand;
  var nombres = $('#responsable_nuevo_tema option:eq(0)').html();
  var nombre = nombres.split(" ");

  orden_dia.push(descripcion);
  responsables.push(moderador);
  orden_dia_control.push(idRand);
  pendientes.push(id_tema);

  notificacionAjax('bg-blue-grey', "Debe seleccionar un responsable.", 2500,  'bottom', 'center', null, null);
  // Se elimina de temas pendientes
  $(`#pendiente_${id_tema}`).tooltip('destroy');
  $(`#pendiente_${id_tema}`).remove();
  // Se genera el codigo HTML correspondiente de los botones
  $('#lista_orden').html($('#lista_orden').html() + `\
  <button id="${boton_id}" type="button" onClick="actualizarOrdenDia(3, ${idRand});" class="list-group-item" \
  style="word-wrap: break-word;" data-usuario="${moderador}" data-toggle="tooltip" data-placement="top" title="Responsable: ${nombres}" data-container="body" data-trigger="hover">${descripcion}</button>`);
  $(`#${boton_id}`).tooltip();
  $('#lista_texto').html($('#lista_texto').html() + `\
    <li id="${lista_texto_id}">${descripcion} => ${nombre[0]} ${nombre[1]}</li>`);
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
  if(indice < 4){
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
    if(indice == 4){
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
      $('#fecha_texto').html(date.format("dddd DD MMMM YYYY [a las] HH:mm [hrs]"));
      $('#fecha_hoy').html(moment().format("dddd DD MMMM YYYY [a las] HH:mm [hrs]"));
      formulario.set('fecha', date.format("YYYY-MM-DD HH:mm"));
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
