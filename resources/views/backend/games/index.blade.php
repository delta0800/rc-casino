@extends('layouts.partials.master')
@section('title', 'Game Providers')
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>Games</h5>
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
                    <table id="games" class="table table-striped table-bordered table-hover nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>imgFileName</th>
                          <th>gameName</th>
                          <th>g_code</th>
                          <th>g_type</th>
                          <th>p_code</th>
                          <th>p_type</th>
                          <th>g_progressive</th>
                          <th>g_code_h5</th>
                          <th>g_code_fun_h5</th>
                          <th>g_code_web</th>
                          <th>g_code_fun_web</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($games as $key => $game)
                        <tr>
                          <td>{{ ++$key }}</td>
                          <td>
                            <img src="{{ $game['imgFileName'] }}" width="50" height="50" class="img-circle">
                          </td>
                          <td>{{ $game['gameName']['gameName_enus'] }}</td>
                          <td>{{ $game['g_code'] }}</td>
                          <td>{{ $game['g_type'] }}</td>
                          <td>{{ $game['p_code'] }}</td>
                          <td>{{ $game['p_type'] }}</td>
                          <td>{{ $game['g_progressive'] }}</td>
                          <td>{{ $game['g_code_h5'] }}</td>
                          <td>{{ $game['g_code_fun_h5'] }}</td>
                          <td>{{ $game['g_code_web'] }}</td>
                          <td>{{ $game['g_code_fun_web'] }}</td>
                        </tr>
                        @endforeach
                      </tbody>
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
    var table = $('#games').DataTable({
      pageLength: 100,
    });
  });
</script>  
@endpush