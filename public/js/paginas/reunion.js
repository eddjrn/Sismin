var indice = 1;
var candado = false;

function finalizar(){
  mensajeAjax('Registro realizado', 'Redireccionando a inicio','success');

  var url = urlToCancelPage + "reunion/1";
  var formdata = new FormData();
  formdata.append('id', id_tipo_reunion);

  // $.ajax({
  //    type:'POST',
  //    url: url,
  //    data:formdata,
  //    processData:false,
  //    contentType:false,
  //    success:function(result){
  //      if(result.errores){
  //       // mensajeAjax('Error', 'Verifique sus datos', 'error');
  //        var errores = '<ul>';
  //        $.each(result.errores,function(indice,valor){
  //          //console.log(indice + ' - ' + valor);
  //          errores += '<li>' + valor + '</li>';
  //        });
  //        errores += '</ul>';
  //        notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
  //      } else{
  //        notificacionAjax('bg-green',result.mensaje, 2500,  'bottom', 'center', null, null);
  //      }
  //     },
  //     error: function (jqXHR, status, error) {
  //      mensajeAjax('Error', error, 'error');
  //     }
  // });
}

function actualizarRol(boton){
  var id_seleccion = boton.id.split("_");
  var id_usuario = id_seleccion[2];
  var id_rol = $(`#${boton.id} option:selected`).val();

  if(id_rol == 0){
    return false;
  } else{
    alert("sidid");
    // aqui va lo que se haga con el rol
  }
}

function actualizarLista(boton){
  // alert(boton.checked);
  if(boton.checked){
    var nombre = $(`#n${boton.id}`).html();
    var id_usuario = boton.id.split("_");
    // alert(id_usuario[2]);
    // return false;
    $(`#a${boton.id}`).show();
    $('#convocados_texto').html($('#convocados_texto').html() + `\
      <li id="nombre_texto${boton.id}">${nombre}</li>\
    `);
    $('#responsable_nuevo_tema').html($('#responsable_nuevo_tema').html() + `\
      <option id="convocado${boton.id}" value="${id_usuario[2]}">${nombre}</option>\
    `);
  } else{
    var id_usuario = boton.id.split("_");
    $(`#a${boton.id}`).hide();
    $(`#nombre_texto${boton.id}`).remove();
    $(`#convocado${boton.id}`).remove();
    $(`#rol_seleccion_${id_usuario[2]}`).val(0);
    $(`#rol_seleccion_${id_usuario[2]}`).selectpicker('refresh');
    // alert(`rol_seleccion_${id_usuario[2]}`);
  }
  $(`#responsable_nuevo_tema`).selectpicker('refresh');
}

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

      $('#descripcion_nuevo_tema').val(null);
      $('#responsable_nuevo_tema').val(0);
      $(`#responsable_nuevo_tema`).selectpicker('refresh');
      $('#filaEliminar').hide();
      $('#btnGuardar').attr("onClick",`actualizarOrdenDia(1, null);`);
      $('#btnEliminar').attr("onClick",`actualizarOrdenDia(1, null);`);
      break;
  }
}

function actualizarFecha(valor){
  var fecha = valor.value;
  // alert(fecha);
}

function actualizarMotivo(valor){
  var motivo = valor.value;
  // alert(motivo);
  $('#motivo_texto').html("Motivo: " + motivo);
  formulario.set('motivo', motivo);
}

function actualizatLugar(valor){
  var lugar = valor.value;
  // alert(lugar);
  $('#lugar_texto').html("Lugar: " + lugar);
  formulario.set('lugar', lugar);
}

function actualizarTipo(opcion){
  // alert(opcion.value);
  var id_tipo_reunion = opcion.value;
  var descripcion = $("#tipo_reunion option:selected").html();
  var imagen = $("#tipo_reunion option:selected").attr("data-imagen");
  // alert(descripcion);
  if(id_tipo_reunion == 0){
    return false;
  }
  $('#tipo_texto').html(descripcion);
  $('#imagen_tipo_reunion').attr("src", imagen);
  $('#imagen_tipo_reunion_texto').attr("src", imagen);

  formulario.set('id_tipo_reunion', id_tipo_reunion);

  var url = urlToCancelPage + "reunion/1";
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
    $(menu).hide();
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

$(function () {
    $('body').removeClass('theme-pink');
    $('body').addClass(tema);

    // Botones
    $('.colorBoton').addClass(colorBtn);
    $('.colorBotonDis').addClass(colorBtnDis);
    $('#anterior').prop( "disabled", true );

    // Checkbox
    $('.chk-col-teal').addClass(colorCheck);
    $('.chk-col-teal').removeClass('chk-col-teal');

    $('.fondo').addClass(fondo);
    $('.oculto').hide();

    //Datetimepicker plugin
    // moment.locale('fr', null);
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
      if(moment(date).isBefore(moment())){
        mensajeAjax('Error', 'La fecha tiene que estar en futuro.','error');
        $('#fecha').val(null);
        return false;
      }
      $('#fecha_texto').html("Fecha de: " + date.format("dddd DD MMMM YYYY [a las] HH:mm [hrs]"));
      $('#fecha_hoy').html(moment().format("dddd DD MMMM YYYY [a las] HH:mm [hrs]"));
      $('#fecha').attr("data-fecha", date.format("YYYY-MM-DD HH:mm"));
      // alert(date.format("DD-MM-YYYY HH:mm"));
      // alert(moment().format("DD-MM-YYYY HH:mm"));
      // alert(date.get('D'));
  	});

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
                "previous": "Anterior",
                "next": "Siguiente"
              }
        },
    });
});
