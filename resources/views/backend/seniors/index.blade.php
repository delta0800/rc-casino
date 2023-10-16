@extends('layouts.partials.master')
@section('title', 'စီနီယာများ')
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>စီနီယာများ</h5>
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
                      <select class="js-example-basic-single w-100" id="js-example-basic-single">
                        <option value="">-- Select Super --</option>
                        @foreach($supers as $super)
                        <option value="{{ $super->id }}">{{ $super->username }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-block">
                  <div class="dt-responsive table-responsive">
                    <table id="seniors" class="table table-bordered table-hover nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Super</th>
                          <th>Name</th>
                          <th>Login Name</th>
                          <th>Percentage</th>
                          <th>Balance</th>
                          <th>CreatedAt</th>
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
<script type="text/javascript">
  $(function () {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    var table = $('#seniors').DataTable({
      processing: true,
      "language": { processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>' },
      serverSide: true,
      pageLength: 25,
      responsive: true,
      ajax: {
        url: "{{ route('seniors.index') }}",
        data: function (d) {                
          d.referral_code = $('.js-example-basic-single').val();
          d.search = $('input[type="search"]').val();
        }
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'super', name: 'super'},
        {data: 'name', name: 'name'},
        {data: 'username', name: 'username'},
        {data: 'percentage', name: 'percentage'},
        {data: 'amount', name: 'amount'},
        {data: 'created_at', name: 'created_at'},
      ],
    });

    $('.js-example-basic-single').change(function(){
      table.draw();
    });

  });
</script>  
@endpush