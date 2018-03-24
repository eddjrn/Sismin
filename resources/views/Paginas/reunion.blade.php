@extends('Layout.layout')

@section('titulo')

@stop

@section('estilos')

<!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{asset('/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />
    <!-- Wait Me Css -->
        <link href="{{asset('/plugins/waitme/waitMe.css')}}" rel="stylesheet" />
        <!-- Multi Select Css -->
  <link href="{{asset('/plugins/multi-select/css/multi-select.css')}}" rel="stylesheet">
  <!-- Bootstrap Select Css -->
    <link href="{{asset('/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

    <!-- noUISlider Css -->
    <link href="{{asset('/plugins/nouislider/nouislider.min.css')}}" rel="stylesheet" />


@stop

@section('cabecera')

@stop

@section('contenido')
<!-- Advanced Form Example With Validation -->
          <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="body">
                          <form id="wizard_with_validation" method="POST">
                              <h3>Alta de reunión</h3>
                              <fieldset>
                                  <div class="row">
                                    <div class="col-lg-8">
                                      <div class="form-group form-float">
                                            <div class="form-group">
                                              <div class="form-line">
                                                  <input type="text" class="datetimepicker form-control" placeholder="Por favor ingrese la fecha y la hora" required>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-group form-float">
                                          <div class="form-line">
                                              <p>
                                                  <b>With Search Bar</b>
                                              </p>
                                              <select class="form-control show-tick" data-live-search="true">
                                                  <option>Hot Dog, Fries and a Soda</option>
                                                  <option>Burger, Shake and a Smile</option>
                                                  <option>Sugar, Spice and all things nice</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="form-group form-float">
                                          <div class="form-line">
                                              <input type="text" class="form-control" name="motivo"  required>
                                              <label class="form-label">Motivo de la reunión*</label>
                                          </div>
                                      </div>
                                      <div class="form-group form-float">
                                          <div class="form-line">
                                              <input type="text" class="form-control" name="lugar"  required>
                                              <label class="form-label">Lugar de la reunión*</label>
                                          </div>
                                      </div>
                                      <div>
                                    <div class="col-lg-4">

                                    </div>
                                  </div>
                              </fieldset>

                              <h3>Profile Information</h3>
                              <fieldset>
                                  <div class="form-group form-float">
                                      <div class="form-line">
                                          <input type="text" name="name" class="form-control" required>
                                          <label class="form-label">First Name*</label>
                                      </div>
                                  </div>
                                  <div class="form-group form-float">
                                      <div class="form-line">
                                          <input type="text" name="surname" class="form-control" required>
                                          <label class="form-label">Last Name*</label>
                                      </div>
                                  </div>
                                  <div class="form-group form-float">
                                      <div class="form-line">
                                          <input type="email" name="email" class="form-control" required>
                                          <label class="form-label">Email*</label>
                                      </div>
                                  </div>
                                  <div class="form-group form-float">
                                      <div class="form-line">
                                          <textarea name="address" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                          <label class="form-label">Address*</label>
                                      </div>
                                  </div>
                                  <div class="form-group form-float">
                                      <div class="form-line">
                                          <input min="18" type="number" name="age" class="form-control" required>
                                          <label class="form-label">Age*</label>
                                      </div>
                                      <div class="help-info">The warning step will show up if age is less than 18</div>
                                  </div>
                              </fieldset>

                              <h3>Terms & Conditions - Finish</h3>
                              <fieldset>
                                  <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                                  <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                              </fieldset>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
@stop

@section('scripts')
<!-- Jquery Core Js -->
  <script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Select Plugin Js -->
  <script src="{{asset('/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
  <!-- Jquery Validation Plugin Css -->
  <script src="{{asset('/plugins/jquery-validation/jquery.validate.js')}}"></script>
  <!-- JQuery Steps Plugin Js -->
  <script src="{{asset('/plugins/jquery-steps/jquery.steps.js')}}"></script>
  <!-- Bootstrap Colorpicker Js -->
    <script src="{{asset('/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>
  <!-- Moment Plugin Js -->
  <script src="{{asset('/plugins/momentjs/moment.js')}}"></script>
  <!-- Autosize Plugin Js -->
  <script src="{{asset('/plugins/autosize/autosize.js')}}"></script>
  <!-- Input Mask Plugin Js -->
  <script src="{{asset('/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
<!-- Multi Select Plugin Js -->
<script src="{{asset('/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
  <!-- Bootstrap Material Datetime Picker Plugin Js -->
      <script src="{{asset('/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
      <!-- Bootstrap Tags Input Plugin Js -->
      <script src="{{asset('/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

      <!-- noUISlider Plugin Js -->
      <script src="{{asset('/plugins/nouislider/nouislider.js')}}"></script>
  <!-- Custom Js -->
  <script src="{{asset('/js/admin.js')}}"></script>
  <script src="{{asset('/js/pages/forms/form-wizard.js')}}"></script>
  <script src="{{asset('/js/pages/forms/basic-form-elements.js')}}"></script>


@stop
