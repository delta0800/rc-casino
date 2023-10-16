@extends('layouts.partials.master')
@section('title', '2D Table')
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>2D Table</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        <div class="page-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group">
                        <span class="input-group-prepend">
                          <label class="input-group-text"><i class="icofont icofont-calendar"></i></label>
                        </span>
                        <input type="text" class="form-control" name="date_filter" id="date_filter">
                      </div>
                    </div>
                    <div class="col-md-4 ml-auto">
                      <select class="js-example-basic-single w-100">
                        <option value="">--- အချိန်ရွေးပါ ---</option>
                        <option value="Morning">မနက်ပိုင်း</option>
                        <option value="Evening">ညနေပိုင်း</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-block">
                  <div class="dt-responsive table-responsive">
                    <table id="bets" class="table table-bordered table-hover nowrap">
                      <thead>
                        <tr>
                          <th>2D</th>
                          <th>Bets</th>
                          <th>Amount </th>
                          <th>Bingo ( {{ $odds }} )</th>
                          <th>Profit & Loss</th>
                        </tr>
                      </thead>
                      <tbody class="text-right"></tbody>
                      <tfoot class="text-right">
                        <tr>
                          <th class="bg-dark text-white">Total :</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var table = $('#bets').DataTable({
    processing: true,
    "language": {
      processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>'
    },
    serverSide: true,
    pageLength: 100,
    ajax: {
      url:'{{ route("master.reports.index") }}',
      data: function(d) {
        d.search = $('input[type="search"]').val();
        d.date_range = $('#date_filter').val();
        d.lottery_time = $('.js-example-basic-single').val();
      }
    },
    columns: [
      {data: 'number', name: 'number'},
      {data: 'user_count', name: 'user_count'},
      {data: 'amount', name: 'amount'},
      {data: 'compensation', name: 'compensation'},
      {data: 'profit', name: 'profit'},
    ],
    footerCallback: function ( row, data, start, end, display ) {
      var api = this.api(), data;

      // converting to interger to find total
      var intVal = function ( i ) {
        return typeof i === 'string' ?
        i.replace(/[\$,]/g, '')*1 :
        typeof i === 'number' ?
        i : 0;
      };

      // computing column Total of the complete result 
      var user_count = api
      .column( 1 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      var amount = api
      .column( 2 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      // Update footer by showing the total with the reference of the column index 
      $( api.column( 1 ).footer() ).html(user_count);
      $( api.column( 2 ).footer() ).html(amount);
    },
  });

  $('#date_filter').daterangepicker({
    opens: 'right',
    "showDropdowns": true,
    "singleDatePicker": true,
    locale: {
      format: 'YYYY-MM-DD',
    }
  });

  $('#date_filter').change(function() {
    table.draw();
  });

  $('.js-example-basic-single').change(function(){
    table.draw();
  });
</script>
@endpush