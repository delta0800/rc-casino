@extends('layouts.partials.master')
@section('title', 'ပင်မ စာမျက်နှာ')
@section('content')

<div class="pcoded-content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <div class="d-inline">
            <h5>ပင်မ စာမျက်နှာ</h5>
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

              <div class="card product-progress-card">
                <div class="card-block">
                  <div class="row pp-main">
                    <div class="col-xl-3 col-md-6">
                      <div class="pp-cont">
                        <div class="row align-items-center m-b-20">
                          <div class="col-auto">
                            <i class="fas fa-users f-24 text-mute"></i>
                          </div>
                          <div class="col text-right">
                            <h2 class="m-b-0 text-c-blue">{{number_format($count_user)}}</h2>
                          </div>
                        </div>
                        <div class="row align-items-center m-b-15">
                          <div class="col-auto">
                            <p class="m-b-0">Users</p>
                          </div>
                          <div class="col text-right">
                            <p class="m-b-0 text-c-blue">{{number_format($sum_user)}}</p>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                      <div class="pp-cont">
                        <div class="row align-items-center m-b-20">
                          <div class="col-auto">
                            <i class="fas fa-users f-24 text-mute"></i>
                          </div>
                          <div class="col text-right">
                            <h2 class="m-b-0 text-c-red">{{number_format($count_agent)}}</h2>
                          </div>
                        </div>
                        <div class="row align-items-center m-b-15">
                          <div class="col-auto">
                            <p class="m-b-0">Agents</p>
                          </div>
                          <div class="col text-right">
                            <p class="m-b-0 text-c-red">{{number_format($sum_agent)}}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                      <div class="pp-cont">
                        <div class="row align-items-center m-b-20">
                          <div class="col-auto">
                            <i class="fas fa-users f-24 text-mute"></i>
                          </div>
                          <div class="col text-right">
                            <h2 class="m-b-0 text-c-yellow">{{number_format($count_master)}}</h2>
                          </div>
                        </div>
                        <div class="row align-items-center m-b-15">
                          <div class="col-auto">
                            <p class="m-b-0">Masters</p>
                          </div>
                          <div class="col text-right">
                            <p class="m-b-0 text-c-yellow">{{number_format($sum_master)}}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                      <div class="pp-cont">
                        <div class="row align-items-center m-b-20">
                          <div class="col-auto">
                            <i class="fas fa-users f-24 text-mute"></i>
                          </div>
                          <div class="col text-right">
                            <h2 class="m-b-0 text-c-green">{{number_format($count_senior)}}</h2>
                          </div>
                        </div>
                        <div class="row align-items-center m-b-15">
                          <div class="col-auto">
                            <p class="m-b-0">Seniors</p>
                          </div>
                          <div class="col text-right">
                            <p class="m-b-0 text-c-green">{{number_format($sum_senior)}}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-block">
                  <div class="row">
                    <div class="col-xl-3 col-md-6">
                      <h6>Completed Deposits</h6>
                      <h5 class="f-w-700">{{number_format($deposits_senior)}}</h5>
                    </div>
                    <div class="col-xl-3 col-md-6">
                      <h6>Completed Withdrawals</h6>
                      <h5 class="f-w-700">{{number_format($withdrawals_senior)}}</h5>
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
</div>

@endsection