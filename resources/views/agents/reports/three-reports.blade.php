@extends('layouts.partials.master')
@section('title', '3D Table')
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>3D Table</h5>
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
                  </div>
                </div>
                <div class="card-block">
                  <div class="dt-responsive table-responsive">
                    <table id="three-bets" class="table table-bordered table-hover nowrap">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>3D</th>
                          <th>Bets</th>
                          <th>Amount </th>
                          <th>Bingo ( {{ $odds }} )</th>
                          <th>Profit & Loss</th>
                        </tr>
                      </thead>
                    <tbody class="text-right"></tbody>
                    <tfoot class="text-right">
                    <tr>
                      <th colspan="2" class="bg-dark text-white">Total :</th>
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

  var table = $('#three-bets').DataTable({
    processing: true,
    "language": {
      processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>'
    },
    serverSide: true,
    pageLength: 25,
    ajax: {
      url:'{{ route("agent.3d-reports.index") }}',
      data: function(d) {
        d.search = $('input[type="search"]').val();
        d.date_range = $('#date_filter').val();
      }
    },
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
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
      .column( 2 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      var amount = api
      .column( 3 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      // Update footer by showing the total with the reference of the column index 
      $( api.column( 2 ).footer() ).html(user_count);
      $( api.column( 3 ).footer() ).html(amount);
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
</script>
@endpush