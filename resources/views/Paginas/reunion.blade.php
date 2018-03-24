@extends('Layout.layout')

@section('titulo')
Nueva reunión
@stop

@section('estilos')
<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{asset('/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />

<!-- Wait Me Css -->
<link href="{{asset('/plugins/waitme/waitMe.css')}}" rel="stylesheet" />

<!-- Bootstrap Select Css -->
<link href="{{asset('/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

<!-- Multi Select Css -->
<link href="{{asset('/plugins/multi-select/css/multi-select.css')}}" rel="stylesheet">

<!-- JQuery DataTable Css -->
<link href="{{asset('/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@stop

@section('cabecera')
Nueva reunión
@stop

@section('contenido')
<!-- Advanced Form Example With Validation -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <form id="wizard_with_validation" method="POST">
                    <h3><div class="hidden-xs">Alta de reunión</div></h3>
                    <fieldset>
                      <div class="row">
                          <div class="col-lg-4 col-md-4 col-lg-offset-1 col-md-offset-1">
                            <div class="form-group form-float">
                              <div class="form-line">
                                  <input type="text" class="datetimepicker form-control" name="fecha" required>
                                  <label class="form-label">Fecha y hora</label>
                              </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="motivo" required>
                                    <label class="form-label">Motivo de la reunión</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="lugar" required>
                                    <label class="form-label">Lugar de la reunión</label>
                                </div>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-lg-offset-2 col-md-offset-2">
                            <p class="col-grey">Tipo de reunión</p>
                            <select class="form-control show-tick" data-live-search="true">
                                <option>Seleccionar</option>
                                <option>Burger, Shake and a Smile</option>
                            </select>
                            <img class="img-responsive thumbnail" src="{{asset('/images/iconoFull.svg')}}" width="150" height="150" style="margin: auto;">
                          </div>
                      </div>
                    </fieldset>

                    <h3><div class="hidden-xs">Convocados</div></h3>
                    <fieldset>
                      <div class="table-responsive">
                          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                              <thead>
                                  <tr>
                                      <th>Nombre</th>
                                      <th>Correo electrónico</th>
                                      <th>Rol dentro de la reunión</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                      <th>Nombre</th>
                                      <th>Correo electrónico</th>
                                      <th>Rol dentro de la reunión</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                                  <tr>
                                      <td>Tiger Nixon</td>
                                      <td>System Architect</td>
                                      <td>Edinburgh</td>
                                  </tr>
                                  <tr>
                                      <td>Tiger Nixon</td>
                                      <td>System Architect</td>
                                      <td>Edinburgh</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </fieldset>

                    <h3><div class="hidden-xs">Orden del día</div></h3>
                    <fieldset>

                      <select id="optgroup" class="ms" multiple="multiple">
                          <optgroup label="Alaskan/Hawaiian Time Zone">
                              <option value="AK">Alaska</option>
                              <option value="HI">Hawaii</option>
                          </optgroup>
                          <optgroup label="Pacific Time Zone">
                              <option value="CA">California</option>
                              <option value="NV">Nevada</option>
                              <option value="OR">Oregon</option>
                          </optgroup>
                          <optgroup label="Mountain Time Zone">
                              <option value="AZ">Arizona</option>
                              <option value="CO">Colorado</option>
                              <option value="ID">Idaho</option>
                          </optgroup>
                          <optgroup label="Central Time Zone">
                              <option value="AL">Alabama</option>
                              <option value="AR">Arkansas</option>
                              <option value="IL">Illinois</option>
                          </optgroup>
                          <optgroup label="Eastern Time Zone">
                              <option value="CT">Connecticut</option>
                              <option value="DE">Delaware</option>
                              <option value="FL">Florida</option>
                          </optgroup>
                      </select>
                    </fieldset>

                    <h3><div class="hidden-xs">Resumen</div></h3>
                    <fieldset>
                        <div class="well">
                          csdcnsdkcsd
                          fsfdgffdgd
                          dfgdfgdf
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Advanced Form Example With Validation -->
@stop

@section('scripts')
<!-- Jquery Validation Plugin Css -->
<script src="{{asset('/plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('/plugins/jquery-validation/localization/messages_es.js')}}"></script>

<!-- JQuery Steps Plugin Js -->
<script src="{{asset('/plugins/jquery-steps/jquery.steps.js')}}"></script>

<script src="{{asset('/js/pages/forms/form-wizard.js')}}"></script>

<!-- Autosize Plugin Js -->
<script src="{{asset('/plugins/autosize/autosize.js')}}"></script>

<!-- Select Plugin Js -->
<script src="{{asset('/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<!-- Multi Select Plugin Js -->
<script src="{{asset('/plugins/multi-select/js/jquery.multi-select.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

<!-- Moment Plugin Js -->
<script src="{{asset('/plugins/momentjs/moment.js')}}"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{asset('/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

<script>
$(function () {
    //Datetimepicker plugin
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        clearButton: true,
        weekStart: 1
    });

    $('.js-basic-example').DataTable({
        responsive: true
    });

    //Multi-select
    $('#optgroup').multiSelect({ selectableOptgroup: true });
});
</script>

@stop
