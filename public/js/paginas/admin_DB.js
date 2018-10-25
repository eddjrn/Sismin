// function archivo(datos, nombre_archivo, tipo){
//   var archivo = new Blob([datos],{ type: "text/plain"});
//   var a = document.createElement("a"),url = URL.createObjectURL(archivo);
//   var date = Date.now();
//   a.href=url;
//   a.download = nombre_archivo + date + tipo;
//   document.body.appendChild(a);
//   a.click();
//   setTimeout(function(){
//     document.body.removeChild(a);
//     window.URL.revokeObjectURL(url);
//   },0);
// }

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
           location.href = url + "base_datos/";
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
