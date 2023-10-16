@extends('layouts.partials.master')
@section('title', 'ပရိုဖိုင် အချက်အလက်များ')
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>ပရိုဖိုင် အချက်အလက်များ</h5>
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
                <div class="card-body">
                  <div class="form-group">
                      <label >Balance</label>
                      <input class="form-control form-bg-inverse" value="{{$master->amount}}">
                    </div>
                    <div class="form-group">
                      <label>Name</label>
                      <input class="form-control" value="{{ $master->name }}" readonly>
                    </div>
                    <div class="form-group">
                      <label >မိတ်ဆက်ကုဒ်</label>
                      <input class="form-control" value="{{$master->username}}" readonly>
                    </div>
                    <div class="form-group">
                      <label>MM 2D %</label>
                      <input class="form-control" value="{{ $master->two_percentage }}" readonly>
                    </div>
                    <div class="form-group">
                      <label >MM 3D %</label>
                      <input class="form-control" value="{{$master->three_percentage}}" readonly>
                    </div>
                    <div class="form-group">
                      <label >Registered Date</label>
                      <input class="form-control" value="{{ $master->created_at }}" readonly>
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