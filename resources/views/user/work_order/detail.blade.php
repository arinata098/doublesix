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
      <h2 class="section-title">{{ $title }}</h2>
      <p class="section-lead">
        {{ $desc }}
      </p>

      <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                    <h4>{{ $title }} {{ $section }}</h4>
                    </div>
                    <div class="card-body">

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Start Date</label>
                            <input type="date" disabled class="form-control" value="{{ $workOrder->startWorkOrder }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Request By</label>
                            <input type="text" disabled class="form-control" value="{{ $workOrder->userWo->name }}">
                        </div>
                      </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" disabled class="form-control" value="{{ $workOrder->workOrderName }}" >

                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select disabled class="form-control select2">
                            <option value="{{ $workOrder->idCategory }}" selected>{{ $workOrder->categoryWo->cateName }}</option>
                        </select>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-6">
                        <label>From Department</label>
                        <select class="form-control select2" disabled>
                              <option value="{{ $workOrder->fromDept }}" >{{ $workOrder->deptFrom->deptName }}</option>
                        </select>
                      </div>
                      <div class="form-group col-lg-6">
                        <label>To Department</label>
                        <select class="form-control select2" disabled>
                            <option value="{{ $workOrder->toDept }}" >{{ $workOrder->deptTo->deptName }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <select  class="form-control select2" disabled>
                            <option value="{{ $workOrder->idLocation }}" >{{ $workOrder->locationWo->locationName }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hourly Estimate</label>
                        <input type="text" class="form-control" value="{{ $workOrder->estimate }} Hours" disabled>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" value="{{ $workOrder->description }}" disabled></input>
                    </div>

                    <div class="form-group">
                        <label>Date End</label>
                        <input type="date" disabled class="form-control" value="{{ $workOrder->startWorkOrder }}">
                    </div>
                    <div class="form-group">
                        <label>completeBy</label>
                        <input type="text" disabled class="form-control" value="{{ $workOrder->completeBy }}" required>
                    </div>
                    <div class="form-group">
                    <label>Status</label>
                    <select name="status" disabled class="form-control select2 @error('status') is-invalid @enderror" required>
                            <option value="0" @if ($workOrder->status == 0) selected @endif>Pending</option>
                            <option value="1" @if ($workOrder->status == 1) selected @endif>On Progress</option>
                            <option value="2" @if ($workOrder->status == 2) selected @endif>Done</option>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Note</label>
                      <input type="text" class="form-control" value="{{ $workOrder->note }}" disabled></input>
                    </div>

                    <!-- Menampilkan foto yang telah diunggah -->
                    @if ($workOrder->photo)
                    <img src="{{ asset('uploads/' . $workOrder->photo) }}" alt="User Photo">
                    @else
                    <p>Belum ada foto yang diunggah</p>
                    @endif

                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ url()->previous() }}" class="btn btn-primary mr-1">Back</a>
                    </div>
                </div>
        </div>
      </div>
    </div>

    <script>
        // Mendapatkan tanggal saat ini
        var today = new Date();
    
        // Format tanggal sebagai "YYYY-MM-DD" agar sesuai dengan format input tanggal HTML
        var formattedDate = today.toISOString().substr(0, 10);

        // Mengatur nilai awal input tanggal ke tanggal saat ini
        document.getElementById("tanggal").value = formattedDate;

        const input = document.getElementById('estimate_hours');
        input.addEventListener('input', function(event) {
            const value = event.target.value;
            event.target.value = value.replace(/[^0-9]/g, '');
        });
    </script>

  </section>
@endsection
