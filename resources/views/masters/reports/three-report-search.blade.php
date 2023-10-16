@extends('layouts.partials.master')
@section('title', '3D Reports')
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>3D Reports</h5>
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
                      <select class="js-example-basic-single w-100" id="js-example-basic-single">
                        <option value="">--- အေးဂျင့် ရွေးပါ ---</option>
                        @foreach($agents as $agent)
                        <option value="{{ $agent->id }}">{{ $agent->username }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-block">
                  <div class="dt-responsive table-responsive">
                    <table id="bets" class="table table-bordered table-hover nowrap">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Name</th>
                          <th>Bets (%)</th>
                          <th>Bets</th>
                          <th>Agent Com :</th>
                          <th>Master Com :</th>
                          <th>Amount </th>
                          <th>Bingo</th>
                          <th>Votes</th>
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

  var table = $('#bets').DataTable({
    processing: true,
    "language": {
      processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>'
    },
    serverSide: true,
    pageLength: 25,
    ajax: {
      url:'{{ route("master.3d-report-search.index") }}',
      data: function(d) {
        d.search = $('input[type="search"]').val();
        d.date_range = $('#date_filter').val();
        d.agent = $('#js-example-basic-single').val();
      }
    },
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
      {data: 'name', name: 'name'},
      {data: 'contribution', name: 'contribution'},
      {data: 'agent_commission', name: 'agent_commission'},
      {data: 'master_commission', name: 'master_commission'},
      {data: 'three_digit_count', name: 'three_digit_count'},
      {data: 'amount', name: 'amount'},
      {data: 'compensation', name: 'compensation'},
      {data: 'votes', name: 'votes'},
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

      var three_digit_count = api
      .column( 5 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      var amount = api
      .column( 6 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      var compensation = api
      .column( 7 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      var votes = api
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
      $( api.column( 5 ).footer() ).html(three_digit_count);
      $( api.column( 6 ).footer() ).html(amount);
      $( api.column( 7 ).footer() ).html(compensation);
      $( api.column( 8 ).footer() ).html(votes);
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
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
          'month').endOf('month')],
      'This Year': [moment().startOf('year'), moment().endOf('year')],
      'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year')
          .endOf('year')
      ],
      'All time': [moment().subtract(30, 'year').startOf('month'), moment().endOf('month')],
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