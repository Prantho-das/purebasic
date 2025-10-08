@extends('layouts.visitor')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="row">
      <div class="col-md-3">
          <div class="card text-white bg-flat-color-1">
              <div class="card-body pb-0" style="text-align: center;">
                  <h4 class="mb-0">
                    @php
                      $id = Session:: get('id');
                      $total_post=App\Post:: where('visitor_id',$id)->count();
                    @endphp
                      <span class="count">
                        {{$total_post}}
                      </span>
                  </h4>
                  <p class="text-light">Totall Post</p>
                  <div class="chart-wrapper px-0" style="height:70px;" height="70">
                      <canvas id="widgetChart1"></canvas>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div> <!-- .content -->
</div>
@endsection
