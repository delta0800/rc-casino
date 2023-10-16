@extends('layouts.partials.master')
@section('title', 'Game Providers')
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>Betting Logs</h5>
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
                <div class="card-block">
                  <div class="dt-responsive table-responsive">
                    <table id="bettings" class="table table-bordered table-hover nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>ref_no</th>
                          <th>site</th>
                          <th>product</th>
                          <th>member</th>
                          <th>gameid</th>
                          <th>start_time</th>
                          <th>end_time</th>
                          <th>match_time</th>
                          <th>bet_detail</th>
                          <th>turnover</th>
                          <th>bet</th>
                          <th>payout</th>
                          <th>commission</th>
                          <th>p_share</th>
                          <th>p_win</th>
                          <th>status</th>
                        </tr>
                      </thead>
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
  $(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var table = $('#bettings').DataTable({
      processing: true,
      "language": { processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>' },
      serverSide: true,
      pageLength: 25,
      ajax: {
        url: "{{ route('bettings.index') }}",
        data: function (d) {                
          d.search = $('input[type="search"]').val()
        }
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'ref_no', name: 'ref_no'},
        {data: 'site', name: 'site'},
        {data: 'product', name: 'product'},
        {data: 'member', name: 'member'},
        {data: 'gameid', name: 'gameid'},
        {data: 'start_time', name: 'start_time'},
        {data: 'end_time', name: 'end_time'},
        {data: 'match_time', name: 'start_time'},
        {data: 'bet_detail', name: 'bet_detail'},
        {data: 'turnover', name: 'turnover'},
        {data: 'bet', name: 'bet'},
        {data: 'payout', name: 'payout'},
        {data: 'commission', name: 'commission'},
        {data: 'p_share', name: 'p_share'},
        {data: 'p_win', name: 'p_win'},
        {data: 'status', name: 'status'},
      ],
    });
  });
</script>
@endpush