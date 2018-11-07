
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

function agregarUsr(id_grupo){
var usuarios = $('#usuarios_'+id_grupo).children();

}
