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
                <label class="mt-2">Category</label>
                <select name="idCategory" class="form-control select2 @error('idCategory') is-invalid @enderror">
                  <option value="" selected>Select Category</option>
                      @foreach ($categoryCollection as $category)
                      <option value="{{ $category->idCategory }}" @if ($category->idCategory == old('category')) selected
                          @endif>{{ $category->cateName }}</option>
                      @endforeach
              </select>
                <!--end::Datepicker-->
              </div>
              <!--end::Input-->
            </div>
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

      <a href=""></a>
      <div class="col-12 col-md-4 col-lg-4 mb-4">
        <div class="hero bg-warning text-white">
          <div class="hero-inner">
            <h1>{{ $woPending }}</h1>
            <p class="lead">Request work order has Pending.</p>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-4 col-lg-4 mb-4">
        <div class="hero bg-primary text-white">
          <div class="hero-inner">
            <h1>{{ $woProgress }}</h1>
            <p class="lead">Request work order has On Progress.</p>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-4 col-lg-4 mb-4">
        <div class="hero bg-success text-white">
          <div class="hero-inner">
            <h1>{{ $woDone }}</h1>
            <p class="lead">Request work order has Done.</p>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>{{ $title }}</h4>
            {{-- <div class="card-header-action">
              <a href="#}" class="btn btn-success"><i class="fas fa-plus"></i> Create New</a>
            </div> --}}
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped mb-0">
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Titel</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($workOrders as $workOrder)
                  <tr>
                    <td>{{ $workOrder->categoryWo->cateName }}</td>
                    <td>{{ $workOrder->workOrderName }}</td>
                    <td>{{ $workOrder->startWorkOrder }}</td>
                    @if ($workOrder->status == 0)
                      <td><div class="badge badge-warning">Pending</div></td>
                    @elseif ($workOrder->status == 1)
                      <td><div class="badge badge-primary">On Progress</div></td>
                    @elseif ($workOrder->status == 2)
                      <td><div class="badge badge-success">Done</div></td>
                    @endif
                    <td>
                      <a href="{{ route('wo.detail', $workOrder->idWorkOrder) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="View"><i class="fas fa-eye"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="d-flex justify-content-end mr-3 mt-3">
                {{ $workOrders->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>

      
    </div>
  </div>
</section>
@endsection
