var indice = 1;
var candado = false;
// Listas de datos a llenar
var formulario = new FormData();
// Se agrega al usuario logueado a la nueva lista
var convocados = [moderador];
var roles = [1];

var orden_dia = [];
var responsables = [];
// Control del la orden del día y sus responsables
var orden_dia_control = [];

// Función que se ejecutara cuando se finalice el formulario
function finalizar(){
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
       mensajeAjax('Error', error, 'error');
      }
  });
}

// Función que se ejecuta al seleccionar un rol para el usuario
function actualizarRol(boton){
  var id_seleccion = boton.id.split("_");
  var id_usuario = id_seleccion[2];
  var id_rol = $(`#${boton.id} option:selected`).val();
  // Cambia el id del rol dentro de la lista de registros creada a la hora de palomear un usuario
  var indice = convocados.indexOf(id_usuario);
  if(indice!=-1){
     roles[indice] = id_rol;
  }
  if(id_rol == 0){
    roles[indice] = 1;
    notificacionAjax('bg-red', "Debe de elegir un rol para el usuario.", 2500,  'bottom', 'center', null, null);
  }
}

// Función que se ejecuta al palomear un usuario
function actualizarLista(boton){
  // Checa si esta palomeado el usuario
  if(boton.checked){
    var nombre = $(`#n${boton.id}`).html();
    var id_usuario = boton.id.split("_");
    convocados.push(id_usuario[2]);
    roles.push(1);
    // Muestra el boton de rol y hace cambios en el resumen
    $(`#a${boton.id}`).show();
    $('#convocados_texto').html($('#convocados_texto').html() + `\
      <li id="nombre_texto${boton.id}">${nombre}</li>\
    `);
    $('#responsable_nuevo_tema').html($('#responsable_nuevo_tema').html() + `\
      <option id="convocado${boton.id}" value="${id_usuario[2]}">${nombre}</option>\
    `);
  } else{
    // Elimina a el usuario de la lista si existe
    var id_usuario = boton.id.split("_");
    var indice = convocados.indexOf(id_usuario[2]);
    if(indice!=-1){
       convocados.splice(indice, 1);
       roles.splice(indice, 1);
    }
    // Oculta el boton de rol y actualiza el resumen de la página
    $(`#a${boton.id}`).hide();
    $(`#nombre_texto${boton.id}`).remove();
    $(`#convocado${boton.id}`).remove();
    $(`#rol_seleccion_${id_usuario[2]}`).val(0);
    $(`#rol_seleccion_${id_usuario[2]}`).selectpicker('refresh');
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
      if(descripcion == "" || seleccion == 0){
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
      <button id="${boton_id}" type="button" onClick="actualizarOrdenDia(3, ${idRand});" class="list-group-item" \
      style="word-wrap: break-word;" data-usuario="${seleccion}">${descripcion}</button>`);
      $('#temasModal').modal('hide');
      $('#descripcion_nuevo_tema').val(null);
      $('#responsable_nuevo_tema').val(0);
      $(`#responsable_nuevo_tema`).selectpicker('refresh');
      $('#lista_texto').html($('#lista_texto').html() + `\
        <li id="${lista_texto_id}">${descripcion} => ${nombre[0]} ${nombre[1]}</li>`);
      break;
    // editar tema existente
    case 2:
      var descripcion = $('#descripcion_nuevo_tema').val();
      var seleccion = $('#responsable_nuevo_tema').val();
      var nombres = $('#responsable_nuevo_tema option:selected').html();
      var nombre = nombres.split(" ");
      // checa si el campo de descripcion esta vacio
      if(descripcion == "" || seleccion == 0){
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
      $(`#ordenDia${boton}`).attr("data-usuario", `${seleccion}`);
      $(`#ordenDia_texto${boton}`).html(descripcion + " => " + nombre[0] + " " + nombre[1]);

      $('#temasModal').modal('hide');
      $('#descripcion_nuevo_tema').val(null);
      $('#responsable_nuevo_tema').val(0);
      $(`#responsable_nuevo_tema`).selectpicker('refresh');
      $('#filaEliminar').hide();
      $('#btnGuardar').attr("onClick",`actualizarOrdenDia(1, null);`);
      $('#btnEliminar').attr("onClick",`actualizarOrdenDia(1, null);`);
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
      $('#filaEliminar').show();
      $('#temasModal').modal('show');
      break;
    // mostrar dialogo vacío
    case 4:
      $('#temasModal').modal('show');
      break;
    // boton de cancelar
    case 5:
      $('#temasModal').modal('hide');
      $('#descripcion_nuevo_tema').val(null);
      $('#responsable_nuevo_tema').val(0);
      $(`#responsable_nuevo_tema`).selectpicker('refresh');
      $('#filaEliminar').hide();
      $('#btnGuardar').attr("onClick",`actualizarOrdenDia(1, null);`);
      $('#btnEliminar').attr("onClick",`actualizarOrdenDia(1, null);`);
      break;
    // boton de eliminar registro
    case 6:
      mensajeAjax('Eliminando', 'Borrando registro','warning');
      $('#temasModal').modal('hide');
      $(`#ordenDia_texto${boton}`).remove();
      $(`#ordenDia${boton}`).remove();
      // Busca el valor en un indice y lo elimina de la lista
      var indice = convocados.indexOf(boton);
      if(indice!=-1){
         orden_dia.splice(indice, 1);
         responsables.splice(indice, 1);
         orden_dia_control.splice(indice, 1);
      }
      // Pone los valores en vacío
      $('#descripcion_nuevo_tema').val(null);
      $('#responsable_nuevo_tema').val(0);
      $(`#responsable_nuevo_tema`).selectpicker('refresh');
      $('#filaEliminar').hide();
      $('#btnGuardar').attr("onClick",`actualizarOrdenDia(1, null);`);
      $('#btnEliminar').attr("onClick",`actualizarOrdenDia(1, null);`);
      break;
  }
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
  if(id_tipo_reunion == 0){
    return false;
  }
  $('#tipo_texto').html('"' + descripcion + '"');
  $('#imagen_tipo_reunion').attr("src", imagen);
  $('#imagen_tipo_reunion_texto').attr("src", imagen);

  formulario.set('tipo_de_reunion', id_tipo_reunion);
  var url = urlToCancelPage + "reunion/1";
  // NO implementado aun ----------------------------------------------------------------
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
         notificacionAjax('bg-green',result.mensaje, 2500,  'bottom', 'center', null, null);
       }
    },
    error: function (jqXHR, status, error) {
     mensajeAjax('Error', error, 'error');
    }
  });

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
    $(menu).hide();
    indice--;
    var paso = "#paso"+indice;
    $(paso).addClass(fondo);
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
    $(menu).hide();
    $(paso).addClass("bg-grey");
    $(paso).removeClass(fondo);
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
        weekStart: 1
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
