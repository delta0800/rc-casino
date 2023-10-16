@extends('layouts.partials.master')
@section('title', '2D Reports')
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>2D Reports</h5>
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
                    <div class="col-md-4">
                      <select class="js-example-basic-single w-100" id="js-example-basic-single">
                        <option value="">--- မာစတာ ရွေးပါ ---</option>
                        @foreach($masters as $master)
                        <option value="{{ $master->id }}">{{ $master->username }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 ml-auto">
                      <select class="js-example-basic-single w-100" id="js-example-basic-single-one">
                        <option value="">--- အချိန်ရွေးပါ ---</option>
                        <option value="Morning">မနက်ပိုင်း</option>
                        <option value="Evening">ညနေပိုင်း</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-block">
                  <div class="dt-responsive table-responsive">
                    <table id="two_lucky_draws" class="table table-bordered table-hover nowrap">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Name</th>
                          <th>Bets (%)</th>
                          <th>Agent Com :</th>
                          <th>Master Com :</th>
                          <th>Senior Com :</th>
                          <th>Bets</th>
                          <th>Amount </th>
                          <th>Bingo</th>
                          <th>Profit & Loss</th>
                        </tr>
                      </thead>
                    <tbody class="text-right"></tbody>
                    <tfoot class="text-right">
                    <tr>
                      <th colspan="3" class="bg-dark text-white">Total :</th>
                      <th></th>
                      <th></th>
                      <th></th>
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

  var table = $('#two_lucky_draws').DataTable({
    processing: true,
    "language": {
      processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>'
    },
    serverSide: true,
    pageLength: 25,
    ajax: {
      url:'{{ route("senior.report-search.index") }}',
      data: function(d) {
        d.search = $('input[type="search"]').val();
        d.date_range = $('#date_filter').val();
        d.lottery_time = $('#js-example-basic-single-one').val();
        d.master = $('#js-example-basic-single').val();
      }
    },
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
      {data: 'name', name: 'name'},
      {data: 'contribution', name: 'contribution'},
      {data: 'agent_commission', name: 'agent_commission'},
      {data: 'master_commission', name: 'master_commission'},
      {data: 'senior_commission', name: 'senior_commission'},
      {data: 'two_digit_count', name: 'two_digit_count'},
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
      var agent_commission = api
      .column( 3 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      var master_commission = api
      .column( 4 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      var senior_commission = api
      .column( 5 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      var two_digit_count = api
      .column( 6 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      var amount = api
      .column( 7 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      var compensation = api
      .column( 8 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      var profit = api
      .column( 9 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      if (profit < 0) {
        var diffColor = '<span class="text-danger font-weight-bold">'+profit+'</span>';
      }else{
        var diffColor = profit;
      }
      
      // Update footer by showing the total with the reference of the column index 
      $( api.column( 3 ).footer() ).html(agent_commission);
      $( api.column( 4 ).footer() ).html(master_commission);
      $( api.column( 5 ).footer() ).html(senior_commission);
      $( api.column( 6 ).footer() ).html(two_digit_count);
      $( api.column( 7 ).footer() ).html(amount);
      $( api.column( 8 ).footer() ).html(compensation);
      $( api.column( 9 ).footer() ).html(diffColor);
    },
  });

  let searchParams = new URLSearchParams(window.location.search)
  let dateInterval = searchParams.get('from-to');
  let start = moment();
  let end = moment();
  console.log(dateInterval)

  if (dateInterval) {
    dateInterval = dateInterval.split(' - ');
    start = dateInterval[0];
    end = dateInterval[1];
  }

  $('#date_filter').daterangepicker({
    opens: 'right',
    "showDropdowns": true,
    "showWeekNumbers": true,
    "alwaysShowCalendars": true,
    startDate: start,
    endDate: end,
    locale: {
        format: 'YYYY-MM-DD',
        firstDay: 1,
    },
  });

  $('#date_filter').change(function() {
    table.draw();
  });

  $('.js-example-basic-single').change(function(){
    table.draw();
  });
</script>
@endpush