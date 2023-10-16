@extends('layouts.partials.master')
@section('title', 'Agents Lists')
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>Agents Lists</h5>
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
                  <div class="d-flex justify-content-between">
                    <div>
                      <a class="btn btn-outline-primary btn-sm" id="createAgent" href="javascript:void(0)"> Create Agent</a>
                    </div>
                  </div>
                </div>
                <div class="card-block">
                  <div class="dt-responsive table-responsive">
                    <table id="agents" class="table table-bordered table-hover nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Login Name</th>
                          <th>2D Limit</th>
                          <th>3D Limit</th>
                          <th>2D %</th>
                          <th>3D %</th>
                          <th>Balance</th>
                          <th>CreatedAt</th>
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
      <form id="agentForm" name="agentForm" class="form-horizontal">
        <div class="modal-body">
          <input type="hidden" name="agent_id" id="agent_id">
          <div class="form-group">
            <label>Name <code>*</code></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" required="">
            <span class="error text-danger d-none"></span>
          </div>
          <div class="form-group">
            <label>2D Limit<code>*</code></label>
            <input type="number" class="form-control" id="allowed_amount" name="allowed_amount">
            <span class="error text-danger d-none"></span>
          </div>
          <div class="form-group">
            <label>3D Limit<code>*</code></label>
            <input type="number" class="form-control" id="allowed_amount_three" name="allowed_amount_three">
            <span class="error text-danger d-none"></span>
          </div>
          <div class="form-group">
            <label>2D Percentage <code>*</code></label>
            <input type="text" class="form-control" id="two_percentage" name="two_percentage" placeholder="Enter 2D Percentage" value="" required="">
            <span class="error text-danger d-none"></span>
          </div>
          <div class="form-group">
            <label>3D Percentage <code>*</code></label>
            <input type="text" class="form-control" id="three_percentage" name="three_percentage" placeholder="Enter 3D Percentage" value="" required="">
            <span class="error text-danger d-none"></span>
          </div>
          <div class="form-group">
            <label>Password <code>*</code></label>
            <input id="password" type="password" class="form-control" name="password" autocomplete="off">
            <span class="error text-danger d-none"></span>
          </div>
          <div class="form-group">
            <label>Confirm Password <code>*</code></label>
            <input type="password" id="confirm-password" class="form-control" name="password_confirmation">
          </div>
          <div class="form-group" id="banned">
            <label>Banned Master</label>
            <select class="form-control" name="banned_till" id="banned_till">
              <option value="">Select Ban Type</option>
              <option value="ban_permanently">Ban permanently</option>
              <option value="ban_for_next_7_days">Ban next 7 days</option>
              <option value="ban_for_next_14_days">Ban next 14 days</option>
            </select>
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

<div class="modal fade" id="ajaxSetupModel" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modelHeadingOne"></h4>
      </div>
      <form id="userFormOne" name="userFormOne" class="form-horizontal">
        <div class="modal-body">
          <input type="hidden" name="agent_id_one" id="agent_id_one">
          <div class="form-group">
            <label>အမည်</label>
            <input type="text" class="form-control" id="nameone" readonly>
          </div>
          <div class="form-group">
            <label>ယူဆာ</label>
            <input type="text" class="form-control" id="username" readonly>
          </div>
          <div class="form-group">
            <label>လက်ကျန်ငွေ</label>
            <input type="text" class="form-control" id="amount" readonly>
          </div>
          <div class="form-group">
            <label>ငွေပမာဏ ထည့်ပါ <code>*</code></label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
            <span id="fuck" class="error text-danger d-none"></span>
          </div>
          <div class="form-group">
            <label>ထည့်/ထုတ် ရွေးပါ <code>*</code></label>
            <div class="form-radio">
              <div class="radio radiofill radio-warning radio-inline">
                <label>
                  <input type="radio" name="status" value="deposit" data-bv-field="status">
                  <i class="helper"></i>အေးဂျင့် ထည့်
                </label>
              </div>
              <div class="radio radiofill radio-warning radio-inline">
                <label>
                  <input type="radio" name="status" value="withdrawal" data-bv-field="status">
                  <i class="helper"></i>အေးဂျင့် ထုတ်
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">ပိတ်မည်</button>
          <button type="submit" class="btn btn-primary waves-effect waves-light " id="saveBtnOne" value="create">အတည်ပြုမည်</button>
        </div>
      </form>
    </div>
  </div>
</div>
  
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
  $(function () {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    var table = $('#agents').DataTable({
      processing: true,
      "language": { processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>' },
      serverSide: true,
      pageLength: 25,
      responsive: true,
      ajax: {
        url: "{{ route('agent-lists.index') }}",
        data: function (d) {                
          d.referral_code = $('.js-example-basic-single').val();
          d.search = $('input[type="search"]').val();
        }
      },
      columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
      {data: 'name', name: 'name'},
      {data: 'username', name: 'username'},
      {data: 'allowed_amount', name: 'allowed_amount'},
      {data: 'allowed_amount_three', name: 'allowed_amount_three'},
      {data: 'two_percentage', name: 'two_percentage'},
      {data: 'three_percentage', name: 'three_percentage'},
      {data: 'amount', name: 'amount'},
      {data: 'created_at', name: 'created_at'},
      {data: 'action', name: 'action'},
      ],
    });

    $('body').on('click', '.addTransaction', function () {
      var agent_id_one = $(this).data('id');
      $.get("{{ route('agent-lists.index') }}" +'/' + agent_id_one +'/edit', function (data) {
        $('#modelHeadingOne').html("အေးဂျင့် ထည့်/ထုတ်");
        $('#ajaxSetupModel').modal('show');
        $('#agent_id_one').val(data.id);
        $('#nameone').val(data.name);
        $('#username').val(data.username);
        $('#amount').val(data.amount);
      })
    });
    
    $('#saveBtnOne').click(function (e) {
      e.preventDefault();
      $(this).html('တင်နေသည်..');
      $.ajax({
        data: $('#userFormOne').serialize(),
        url: "{{ route('agent-transactions.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#userFormOne').trigger("reset");
          $('#ajaxSetupModel').modal('hide');
          table.draw();
        },
        error: function (err) {
          $("#fuck").html(err.responseJSON.message);
          $("#fuck").removeClass('d-none');
          $('#saveBtnOne').html('အတည်ပြုမည်');
        }
      });
    });

    $('#createAgent').click(function () {
      $('#banned').hide();
      $('#saveBtn').val("create-agent");
      $('#agent_id').val('');
      $('#agentForm').trigger("reset");
      $('#modelHeading').html("Create New Agent Profile");
      $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editAgent', function () {
      $('#banned').show();
      var agent_id = $(this).data('id');
      $.get("{{ route('agent-lists.index') }}" +'/' + agent_id +'/edit', function (data) {
        $('#modelHeading').html("Update Agent Profile");
        $('#saveBtn').val("edit-agent");
        $('#ajaxModel').modal('show');
        $('#agent_id').val(data.id);
        $('#amount').val(data.amount);
        $('#name').val(data.name);
        $('#username').val(data.username);
        $('#allowed_amount').val(data.allowed_amount);
        $('#allowed_amount_three').val(data.allowed_amount_three);
        $('#two_percentage').val(data.two_percentage);
        $('#three_percentage').val(data.three_percentage);
      })
    });
    
    $('#saveBtn').click(function (e) {
      e.preventDefault();
      $(this).html('Sending..');
      $.ajax({
        data: $('#agentForm').serialize(),
        url: "{{ route('agent-lists.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#agentForm').trigger("reset");
          $('#ajaxModel').modal('hide');
          table.draw();
          toastr.success(data.success);
        },
        error: function (data) {
          if (data.status == 422) { 
            $.each(data.responseJSON.errors, function(key, value){
              $("#" + key).next().html(value[0]);
              $("#" + key).next().removeClass('d-none');
            });
          }
          console.log('Error:', data);
          $('#saveBtn').html('Save Changes');
        }
      });
    });

    $('body').on('click', '.deleteAgent', function () {
      if(!confirm('Are You sure want to delete !')) return;
      var agent_id = $(this).data("id");
      $.ajax({
        type: "DELETE",
        url: "{{ route('agent-lists.store') }}"+'/'+agent_id,
        success: function (data) {
          table.draw();
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    });

    $('body').on('click', '.restoreAgent', function () {
      var agent_id = $(this).data("id");
      swal.fire({
        title: "Unban?",
        icon: 'question',
        text: "Are you sure you want to unban this agent from the banned agents list?",
        type: "success",
        showCancelButton: true,
        confirmButtonText: "Yes, unban it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
      }).then(function (e) {
        if (e.value === true) {
          var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            type: "GET",
            url: "{{ url('master/restore-agent') }}"+'/'+agent_id,
            data: {_token: CSRF_TOKEN},
            dataType: 'JSON',
            success: function (results) {
              if (results.success === true) {
                swal.fire("Done!", results.message, "success");
                // refresh table after 2 seconds
                setTimeout(function(){
                  table.draw();
                },2000);
              } 
            }
          });
        } else {
          e.dismiss;
        }
      }, function (dismiss) {
        return false;
      })
    });

    $('.js-example-basic-single').change(function(){
      table.draw();
    });

  });
</script>  
@endpush