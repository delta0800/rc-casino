@extends('layouts.partials.master')
@section('title', 'Users')
@push('style')
<style type="text/css">
  #password, #confirm-password{
    -webkit-text-security: disc;
    -moz-text-security:circle;
    text-security:circle;
  }
  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
  }
</style>
@endpush
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>User Lists</h5>
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
                      <a class="btn btn-outline-primary btn-sm" id="createUser" href="javascript:void(0)"> Create User</a>
                    </div>
                  </div>
                </div>
                <div class="card-block">
                  <div class="dt-responsive table-responsive">
                    <table id="users" class="table table-bordered table-hover nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Login Name</th>
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
      <form id="userForm" name="userForm" class="form-horizontal">
        <div class="modal-body">
          <input type="hidden" name="user_id" id="user_id">
          <div class="form-group">
            <label>Name <code>*</code></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" required="">
          </div>
          <div class="form-group">
            <label>Password <code>*</code></label>
            <input id="password" type="number" pattern="[0-9]*" class="form-control" name="password" placeholder="Enter 6 digits" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Confirm Password <code>*</code></label>
            <input type="number" id="confirm-password" class="form-control" placeholder="Enter 6 digits" name="password_confirmation" pattern="[0-9]*">
          </div>
          <div class="form-group" id="banned">
            <label>Banned User</label>
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
          <input type="hidden" name="user_id_one" id="user_id_one">
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
                  <i class="helper"></i>ယူဆာ ထည့်
                </label>
              </div>
              <div class="radio radiofill radio-warning radio-inline">
                <label>
                  <input type="radio" name="status" value="withdrawal" data-bv-field="status">
                  <i class="helper"></i>ယူဆာ ထုတ်
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
    
    var table = $('#users').DataTable({
      processing: true,
      "language": { processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>' },
      serverSide: true,
      pageLength: 25,
      responsive: true,
      ajax: {
        url: "{{ route('user-lists.index') }}",
        data: function (d) {                
          d.referral_code = $('.js-example-basic-single').val();
          d.search = $('input[type="search"]').val();
        }
      },
      columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
      {data: 'name', name: 'name'},
      {data: 'username', name: 'username'},
      {data: 'amount', name: 'amount'},
      {data: 'created_at', name: 'created_at'},
      {data: 'action', name: 'action'},
      ]
    });

    $('body').on('click', '.addTransaction', function () {
      var user_id_one = $(this).data('id');
      $.get("{{ route('user-lists.index') }}" +'/' + user_id_one +'/edit', function (data) {
        $('#modelHeadingOne').html("ယူဆာ ထည့်/ထုတ်");
        $('#ajaxSetupModel').modal('show');
        $('#user_id_one').val(data.id);
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
        url: "{{ route('user-transactions.store') }}",
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

    $('#createUser').click(function () {
      $('#banned').hide();
      $('#saveBtn').val("create-user");
      $('#user_id').val('');
      $('#userForm').trigger("reset");
      $('#modelHeading').html("Create New User");
      $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editUser', function () {
      $('#banned').show();
      var user_id = $(this).data('id');
      $.get("{{ route('user-lists.index') }}" +'/' + user_id +'/edit', function (data) {
        $('#modelHeading').html("Update User");
        $('#saveBtn').val("edit-user");
        $('#ajaxModel').modal('show');
        $('#user_id').val(data.id);
        $('#name').val(data.name);
      })
    });
    
    $('#saveBtn').click(function (e) {
      e.preventDefault();
      $(this).html('Sending..');
      $.ajax({
        data: $('#userForm').serialize(),
        url: "{{ route('user-lists.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#userForm').trigger("reset");
          $('#ajaxModel').modal('hide');
          table.draw();
        },
        error: function (data) {
          console.log('Error:', data);
          $('#saveBtn').html('Save Changes');
        }
      });
    });

    $('body').on('click', '.deleteUser', function () {
      if(!confirm('Are You sure want to delete !')) return;
      var user_id = $(this).data("id");
      $.ajax({
        type: "DELETE",
        url: "{{ route('user-lists.store') }}"+'/'+user_id,
        success: function (data) {
          table.draw();
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
        }
      });
    });

    $('body').on('click', '.restoreUser', function () {
      var user_id = $(this).data("id");
      swal.fire({
        title: "Unban?",
        icon: 'question',
        text: "Are you sure you want to unban this user from the banned users list?",
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
            url: "{{ url('agent/users/restore-user') }}"+'/'+user_id,
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