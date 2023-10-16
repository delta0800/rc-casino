</div>
</div>
  <script type="text/javascript" src="{{ asset('backend/js//jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backend/js/jquery-ui.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backend/js/popper.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backend/js/waves.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
  <script src="{{ asset('backend/js/jquery.flot.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/jquery.flot.categories.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/curvedlines.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/jquery.flot.tooltip.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/amcharts.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/serial.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/light.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/markerclusterer.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/pcoded.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/vertical-layout.min.js') }}" type="text/javascript"></script>
  <script type="text/javascript" src="{{ asset('backend/js/script.min.js') }}"></script>

  <script src="{{ asset('backend/js/jquery.datatables.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/datatables.buttons.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/jszip.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/pdfmake.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/vfs_fonts.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/buttons.print.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/buttons.html5.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/datatables.bootstrap4.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/datatables.responsive.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/responsive.bootstrap4.min.js') }}" type="text/javascript"></script>

  <script src="js/jquery.datatables.min.js" type="dd968ecfaf2317dc95cd417c-text/javascript"></script>
  <script src="js/datatables.buttons.min.js" type="dd968ecfaf2317dc95cd417c-text/javascript"></script>
  <script src="js/jszip.min.js" type="dd968ecfaf2317dc95cd417c-text/javascript"></script>
  <script src="js/pdfmake.min.js" type="dd968ecfaf2317dc95cd417c-text/javascript"></script>
  <script src="js/vfs_fonts.js" type="dd968ecfaf2317dc95cd417c-text/javascript"></script>
  <script src="js/datatables.responsive.min-2.js" type="dd968ecfaf2317dc95cd417c-text/javascript"></script>
  <script src="js/buttons.print.min.js" type="dd968ecfaf2317dc95cd417c-text/javascript"></script>
  <script src="js/buttons.html5.min.js" type="dd968ecfaf2317dc95cd417c-text/javascript"></script>
  <script src="js/datatables.bootstrap4.min.js" type="dd968ecfaf2317dc95cd417c-text/javascript"></script>
  <script src="js/datatables.responsive.min.js" type="dd968ecfaf2317dc95cd417c-text/javascript"></script>
  <script src="js/responsive.bootstrap4.min.js" type="dd968ecfaf2317dc95cd417c-text/javascript"></script>

  <script src="{{ asset('backend/js/rocket-loader.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backend/js/select2.full.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backend/js/select2-custom.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script type="text/javascript" src="{{ asset('backend/js/switchery.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  @stack('scripts')
  <script type="text/javascript">
    if ($('#editable-form').length) {
      $.fn.editable.defaults.mode = 'inline';
        $.fn.editableform.buttons =
          '<button type="submit" class="btn btn-sm waves-effect waves-dark btn-success editable-submit">' +
          '<i class="icofont icofont-ui-check"></i>' +
          '</button>' +
          '<button type="button" class="btn btn-sm waves-effect waves-dark btn-danger editable-cancel">' +
          '<i class="icofont icofont-ui-close"></i>' +
          '</button>';
    }
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>
</body>
</html>