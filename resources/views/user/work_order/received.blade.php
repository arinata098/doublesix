@extends('layouts.main')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">{{ $active }}</a></div>
      <div class="breadcrumb-item">{{ $section }}</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">{{ $section }}</h2>
    <p class="section-lead">
      {{ $desc }}
    </p>
    @if (\Session::has('successUpdate'))
            <div class="alert alert-info">
              Data Update successfully..
            </div>
    @endif
    @if (\Session::has('errorDatanotfound'))
            <div class="alert alert-danger">
              Data not found..
            </div>
    @endif

    <div class="row">
      <div class="col-12 col-md-6 col-lg-12">
        <div class="card card-hero">
            <div class="card-header">
              <div class="card-icon">
                <i class="far fa-question-circle"></i>
              </div>
              <h4>{{ $totalWo }}</h4>
              <div class="card-description">Request work order has received</div>
            </div>
            <div class="card-body p-0">
              <div class="tickets-list">
                
                @foreach ($workOrders as $wo)
                  <a href="{{ route('wo.edit', $wo->idWorkOrder ) }}" class="ticket-item">
                    <div class="ticket-title">
                      <h4>{{ $wo->workOrderName }}</h4>
                    </div>
                    <div class="ticket-info">
                      <div>Request by : {{ $wo->userWo->name }}</div>
                      <div class="bullet"></div>
                      @if ($wo->status == 0)
                        <div class="text-warning">Pending</div>
                        @elseif ($wo->status == 1)
                        <div class="text-primary">On Progress</div>
                        @elseif ($wo->status == 2)
                        <div class="text-success">Done</div>

                      @endif
                    </div>
                  </a>
                @endforeach

              </div>
              <div class="d-flex justify-content-end mr-3 mt-3">
                {{ $workOrders->links() }}
              </div>
            </div>
          </div>
      </div>
      
    </div>
  </div>
</section>
@endsection
