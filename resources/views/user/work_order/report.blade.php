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
    <div class="d-flex flex-row justify-content-between">
      <div class="d-none d-md-block col-lg-4">
        <h2 class="section-title">{{ $section }} @if (session('deptName')) for Department {{ session('deptName') }} @endif </h2>
        <p class="section-lead">
          {{ $desc }}
        </p>
      </div>
      <!--begin::Wrapper-->
      <div class="py-3 d-sm-block col-lg-8">
        <form action="{{ route('wo.report') }}" method="GET">
          {{-- <div class="d-flex justify-content-end"> --}}
          <div class="row justify-content-end">
            <!--begin::Input group-->
          
            <div class="mb-10 col-lg-3 mr-2">
              <!--begin::Input-->
              <div class="position-relative d-inline align-items-center">
                <!--begin::Datepicker-->
                <label class="mt-2">From Date</label>
                <input class="form-control form-control-solid ps-12" required type="date" placeholder="Select a date" name="awal" />
                <!--end::Datepicker-->
              </div>
              <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10 col-lg-3 mr-2">
              <!--begin::Input-->
              <div class="position-relative d-inline align-items-center">
                <!--begin::Datepicker-->
                <label class="mt-2">To Date</label>
                <input class="form-control form-control-solid ps-12" required type="date" placeholder="Select a date" name="akhir" />
                <!--end::Datepicker-->
              </div>
              <!--end::Input-->
            </div>
            <!--end::Input group-->
          </div>
          <div class="d-block mt-2 mr-1" style="text-align: end">
            <button type="submit" class="btn btn-sm btn-primary">Search</button>
          </div>
          <!--end::Actions-->
        </form>
      </div>
      <!--end::Button-->
    </div>
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

      <div class="col-12 col-md-4 col-lg-4 mb-4">
        <a href="{{ route('report.table', ['status' => '0']) }}">
          <div class="hero bg-warning text-white">
            <div class="hero-inner">
              <h1>{{ $woPending }}</h1>
              <p class="lead">Request work order has Pending.</p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-12 col-md-4 col-lg-4 mb-4">
        <a href="{{ route('report.table', ['status' => '1']) }}">
        <div class="hero bg-primary text-white">
          <div class="hero-inner">
            <h1>{{ $woProgress }}</h1>
            <p class="lead">Request work order has On Progress.</p>
          </div>
        </div>
        </a>
      </div>

      <div class="col-12 col-md-4 col-lg-4 mb-4">
        <a href="{{ route('report.table', ['status' => '2']) }}">
          <div class="hero bg-success text-white">
          <div class="hero-inner">
            <h1>{{ $woDone }}</h1>
            <p class="lead">Request work order has Done.</p>
          </div>
        </div>
        </a>
      </div>
      
    </div>
  </div>
</section>
@endsection
