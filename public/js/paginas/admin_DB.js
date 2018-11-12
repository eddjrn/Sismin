function respaldo(){
  inicioSpinner();
  $.ajax({
     type:'GET',
     url: url + "crear_respaldo",
     data: true,
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
         notificacionAjax('bg-green',"Por favor guarde el archivo en un lugar seguro", 10000,  'bottom', 'center', null, null);
         window.setTimeout(function(){
           // alert(url + "descargar_respaldo/" + result.nombre);
           location.href = url + "descargar_respaldo/" + result.nombre;
         } ,3000);
         window.setTimeout(function(){
           location.href = url + "eliminar_respaldo/" + result.nombre;
         } ,4000);


         // archivo(result.datos,"usuarios",".sql");
         finSpinner();
       }
      },
      error: function (jqXHR, status, error) {
        finSpinner();
        mensajeAjax('Error', error, 'error');
      }
  });
}

function descargar(archivo){
  // alert(archivo);
  notificacionAjax('bg-green',"Por favor guarde el archivo en un lugar seguro", 10000,  'bottom', 'center', null, null);
  window.setTimeout(function(){
    location.href = url + "descargar_respaldo/" + archivo;
  } ,3000);
}

function activar(archivo){
  inicioSpinner();
  $.ajax({
     type:'GET',
     url: url + "activar_respaldo/" + archivo,
     data: true,
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
           location.href = url+'recuperacion';
         } ,2000);


       }
      },
      error: function (jqXHR, status, error) {
        finSpinner();
        mensajeAjax('Error', error, 'error');
      }
  });
}

// Función al recargar la página, cambia estilos e inicaliza scripts en español
$(function () {
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
});

function SeleccionarArch(){
  var nArch = document.getElementById('inputArch');
  $('#nombreArch').html(nArch.files[0].name);
}

function SubirRespaldo(){
  var formData = new FormData();
  var archivo = document.getElementById('inputArch');
  formData.append('archivo',archivo.files[0]);
  inicioSpinner();
  $.ajax({
     type:'POST',
     url: url + "subir_respaldo",
     data: formData,
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
           // alert(url + "descargar_respaldo/" + result.nombre);
           location.href = url + "recuperacion";
         } ,3000);
         // archivo(result.datos,"usuarios",".sql");
         finSpinner();
       }
      },
      error: function (jqXHR, status, error) {
        finSpinner();
        mensajeAjax('Error', error, 'error');
      }
  });
}

function editar(id){
  var nombre = document.getElementById('Nombre_'+id).innerHTML;
  var a_paterno = document.getElementById('apellido_p_'+id).innerHTML;
  var a_materno = document.getElementById('apellido_m_'+id).innerHTML;
  var correo = document.getElementById('correo_electronico_'+id).innerHTML;
  $('#usr').html(nombre+' '+a_paterno+' '+ a_materno);
  $('#nombre').val(nombre);
  $('#a_paterno').val(a_paterno);
  $('#a_materno').val(a_materno);
  $('#correo_electronico').val(correo);
  $('#guardar').attr('onclick','guardarC('+id+')');
}

function guardarC(id){
  var formData = new FormData();
  formData.append('nombre',$('#nombre').val());
  formData.append('a_paterno',$('#a_paterno').val());
  formData.append('a_materno',$('#a_materno').val());
  formData.append('correo',$('#correo_electronico').val());
  formData.append('id_usuario',id);
  inicioSpinner();
  $.ajax({
     type:'POST',
     url: url + "actualizar_usuario",
     data: formData,
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
           // alert(url + "descargar_respaldo/" + result.nombre);
           location.href = url + "base_datos";
         } ,3000);
         // archivo(result.datos,"usuarios",".sql");
         finSpinner();
       }
      },
      error: function (jqXHR, status, error) {
        finSpinner();
        mensajeAjax('Error', error, 'error');
      }
  });
}

function activarEstatus(id){
   var f = 0;
  var check = $("#estatus_"+id).is(':checked');
  if(check){
    f = 1;
  } else{
    f=0;
  }

  $.ajax({
     type:'POST',
     url:  url + "activar_estatus",
     data:
     {
       "id_usuario":id,
       "activado":f
     },
     success:function(result){
       if(result.errores){
         var errores = '<ul>';
         $.each(result.errores,function(indice,valor){
           errores += '<li>' + valor + '</li>';
         });
         errores += '</ul>';
         notificacionAjax('bg-red',errores, 2500,  'bottom', 'center', null, null);
       } else{
         mensajeAjax('Registro correcto', result.mensaje,'success');
         window.setTimeout(function(){
           location.href = url + "base_datos";
         } ,3000);
       }
    },
    error: function (jqXHR, status, error) {
     mensajeAjax('Error', error, 'error');
    }
  });
}

function delegarResponsabilidad(opc, id){
  switch(opc){
    case 1:
      $('#delegarResp').attr('onclick', `delegarResponsabilidad(2, ${id})`);
      break;
    case 2:
      $.ajax({
         type:'POST',
         url:  url + "delegar_responsabilidad",
         data:
         {
           "id_usuario":id,
         },
         success:function(result){
           if(result.errores){
             var errores = '<ul>';
             $.each(result.errores,function(indice,valor){
               errores += '<li>' + valor + '</li>';
             });
             errores += '</ul>';
             notificacionAjax('bg-red',errores, 2500,  'bottom', 'center', null, null);
           } else{
             mensajeAjax('Registro correcto', result.mensaje,'success');
             window.setTimeout(function(){
               location.href = url + "base_datos";
             } ,3000);
           }
        },
        error: function (jqXHR, status, error) {
         mensajeAjax('Error', error, 'error');
        }
      });
      break;
  }
}
