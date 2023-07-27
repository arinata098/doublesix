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
        <h2 class="section-title">{{ $section }}</h2>
        <p class="section-lead">
          {{ $desc }}
        </p>
      </div>

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
    @if (session('fail'))
      <div class="alert alert-danger">
          {{ session('fail') }}
      </div>
  @endif

    <div class="row">

      @foreach ($departmentCollection as $department)
      <div class="col-12 col-md-4 col-lg-4 mb-4">
      <a href="{{ route('wo.report', ['idDept' => $department->idDept, 'deptName' => $department->deptName]) }}">
          <div class="hero bg-dark text-white">
            <div class="hero-inner">
              <h1>{{ $department->deptName }}</h1>
              <p class="lead">Request receive by department {{ $department->deptName }}.</p>
            </div>
          </div>
        </a>
      </div>
      @endforeach
      
    </div>
  </div>
</section>
@endsection
