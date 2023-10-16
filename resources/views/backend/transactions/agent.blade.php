@extends('layouts.partials.master')
@section('title', 'အေးဂျင့် ထည့်/ထုတ်')
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>အေးဂျင့် ထည့်/ထုတ်</h5>
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
                        <option value="">-- Select Master --</option>
                        @foreach($masters as $master)
                        <option value="{{ $master->id }}">{{ $master->username }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 ml-auto">
                      <select class="js-example-basic-single w-100" id="js-example-basic-single-one">
                        <option value="deposit">ထည့်</option>
                        <option value="withdrawal">ထုတ်</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-block">
                  <div class="dt-responsive table-responsive">
                    <table id="transactions" class="table table-bordered table-hover nowrap">
                      <thead>
                        <tr>
                          <th>စဉ်</th>
                          <th>အချိန်</th>
                          <th>မှ</th>
                          <th>အမည်</th>
                          <th>သို့</th>
                          <th>ထည့်/ထုတ်</th>
                          <th>မတိုင်မှီ</th>
                          <th>ငွေပမာဏ</th>
                          <th>ပြီးနောက်</th>
                        </tr>
                      </thead>
                      <tfoot class="text-right">
                        <tr>
                          <th colspan="6" class="bg-dark text-white">Total :</th>
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
<script type="text/javascript">
  $(function () {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    var table = $('#transactions').DataTable({
      processing: true,
      "language": { processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>' },
      serverSide: true,
      pageLength: 25,
      responsive: true,
      ajax: {
        url: "{{ route('agent-transactions.index') }}",
        data: function (d) {    
          d.search = $('input[type="search"]').val();
          d.date_range = $('#date_filter').val();
          d.status = $('#js-example-basic-single-one').val();
          d.referral_code = $('#js-example-basic-single').val();
        }
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'created_at', name: 'created_at'},
        {data: 'master', name: 'master'},
        {data: 'name', name: 'name'},
        {data: 'username', name: 'username'},
        {data: 'status', name: 'status'},
        {data: 'before', name: 'before'},
        {data: 'amount', name: 'amount'},
        {data: 'after', name: 'after'},
      ],
      columnDefs: [
      { 
        targets: [5,6,7],
        className: 'text-right'
      }],
      footerCallback: function ( row, data, start, end, display ) {
        var api = this.api(), data;

        // converting to interger to find total
        var intVal = function ( i ) {
          return typeof i === 'string' ?
          i.replace(/[\$,]/g, '')*1 :
          typeof i === 'number' ?
          i : 0;
        };

        var before = api
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

        var after = api
        .column( 7 )
        .data()
        .reduce( function (a, b) {
          return intVal(a) + intVal(b);
        }, 0 );

        // Update footer by showing the total with the reference of the column index 
        $( api.column( 5 ).footer() ).html(before.toLocaleString("en"));
        $( api.column( 6 ).footer() ).html(amount.toLocaleString("en"));
        $( api.column( 7 ).footer() ).html(after.toLocaleString("en"));
      },
    });

    let searchParams = new URLSearchParams(window.location.search)
    let dateInterval = searchParams.get('from-to');
    let start = moment();
    let end = moment();

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

  });
</script>  
@endpush