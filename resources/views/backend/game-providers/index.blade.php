@extends('layouts.partials.master')
@section('title', 'Game Providers')
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>Game Providers</h5>
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
                    <table id="game-providers" class="table table-bordered table-hover nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Image</th>
                          <th>Code</th>
                          <th>Name</th>
                          <th>Supported Game Type</th>
                          <th>Status</th>
                          <th>Action</th>
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

<div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modelHeading"></h4>
      </div>
      <form id="providerForm" name="providerForm" class="form-horizontal">
        <div class="modal-body">
          <input type="hidden" name="provider_id" id="provider_id">
          <div class="form-group">
            <label>Provider Name</label>
            <input type="text" class="form-control" id="name" name="name" value="" required="" readonly>
          </div>
          <div class="form-group">
            <label>Photo</label>
            <input type="file" name="img" id="img" class="form-control">
          </div>
          <div class="form-group">
            <label>Supported Game Type :</label>
            <br>
            @foreach($types as $type)
              <div class="checkbox-fade fade-in-success">
                <label>
                  <input type="checkbox" name="tag[]" value="{{$type->id}}">
                  <span class="cr">
                    <i class="cr-icon icofont icofont-ui-check txt-success"></i>
                  </span>
                  <span>{{$type->name}} ({{$type->code}})</span>
                </label>
              </div>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary waves-effect waves-light " id="saveBtn" value="create">Save changes</button>
        </div>
      </form>
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
    var table = $('#game-providers').DataTable({
      processing: true,
      "language": { processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>' },
      serverSide: true,
      pageLength: 25,
      ajax: {
        url: "{{ route('game-providers.index') }}",
        data: function (d) {                
          d.search = $('input[type="search"]').val()
        }
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'img', name: 'img'},
        {data: 'code', name: 'code'},
        {data: 'name', name: 'name'},
        {data: 'game_type', name: 'game_type'},
        {data: 'status', name: 'status'},
        {data: 'action', name: 'action'},
      ],
    });

    $('body').on('click', '.editProvider', function () {
      var provider_id = $(this).data('id');
      $.get("{{ route('game-providers.index') }}" +'/' + provider_id +'/edit', function (data) {
        $('#modelHeading').html("Update Game Provider");
        $('#saveBtn').val("edit-template");
        $('#ajaxModel').modal('show');
        $('#provider_id').val(data.id);
        $('#name').val(data.name);

        $.each(data.tag,function(key,val)
        {
          $('input[name^="tag"][value="'+val.id+'"]').prop('checked', true);
        })

      })
    });

    $('#saveBtn').click(function (e) {
      e.preventDefault();
      $(this).html('Sending..');
      var formData = new FormData($('#providerForm')[0]);
      $.ajax({
        data: formData,
        url: "{{ route('game-providers.store') }}",
        type: "POST",
        enctype: 'multipart/form-data',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,        
        success: function (data) {
          $('#providerForm').trigger("reset");
          $('#ajaxModel').modal('hide');
          table.draw();
          toastr.success(data.message);
        },
        error: function (data) {
          if (data.status == 422) { 
            $.each(data.responseJSON.errors, function(key, value){
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 5;
              toastr.error(value);
            });
          }
          console.log('Error:', data);
          $('#saveBtn').html('Save Changes');
        }
      });
    });

    $('#game-providers').on('draw.dt', function(){
      let elems = Array.prototype.slice.call(document.querySelectorAll('.js-single'));
      elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'large', color: '#218838', secondaryColor: '#C82333' });
      });
      $('.js-single').change(function () {
        let status = $(this).prop('checked') === true ? "0" : "1";
        let providerId = $(this).data('id');
        $.ajax({
          type: "GET",
          dataType: "json",
          url: '{{ route('provider.changeStatus') }}',
          data: {'status': status, 'provider_id': providerId},
          success: function (data) {
            toastr.success(data.message);
          }
        });
      });
    });

  });
</script>
@endpush