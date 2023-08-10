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

        @if (\Session::has('createFailed'))
            <div class="alert alert-danger">
                Request create failed..
            </div>
        @endif
        @if (\Session::has('createSuccess'))
            <div class="alert alert-info">
              Request created successfully..
            </div>
        @endif

      <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
            <form action="{{ route('wo.update', $workOrder->idWorkOrder) }}" enctype="multipart/form-data" method="POST">
                @csrf
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
                        <label>Description</label>
                        <input type="text" class="form-control" value="{{ $workOrder->description }}" disabled></input>
                    </div>
                    <div class="form-group">
                        <label>Date End</label>
                        <input type="date" readonly class="form-control @error('endWorkOrder') is-invalid @enderror" name="endWorkOrder" id="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label>completeBy</label>
                        @if (Auth::user()->is_admin == 1)
                        <select name="completeBy" 
                          class="form-control select2 @error('completeBy') is-invalid @enderror" required>
                            <option value="" selected>Select User</option>
                                @foreach ($deptUser as $user)
                                <option value="{{ $user->name }}" 
                                  @if ($user->id == old('completeBy')) selected @endif
                                  @if ($user->name === $workOrder->completeBy) selected @endif
                                >
                                  {{ $user->name }}
                                </option>
                                @endforeach
                        </select>
                        @endif 
                        @if (Auth::user()->is_admin == 0)
                          <input type="text" readonly class="form-control @error('completeBy') is-invalid @enderror" name="completeBy" value="{{ $workOrder->completeBy }}" required>
                        @endif
                    </div>
                    <div class="form-group">
                      <label>Hourly Estimate</label>
                      <input type="number" id="estimate_hours" pattern="[0-9]" class="form-control @error('estimate') is-invalid @enderror" name="estimate" value="{{ $workOrder->estimate }}" required>
                      @error('estimate')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control select2 @error('status') is-invalid @enderror" required>
                            <option value="0" @if ($workOrder->status == 0) selected @endif>Pending</option>
                            <option value="1" @if ($workOrder->status == 1) selected @endif>On Progress</option>
                            <option value="2" @if ($workOrder->status == 2) selected @endif>Done</option>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Note</label>
                      <input type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ $workOrder->note }}"></input>
                      @error('note')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Photo</label>
                      <input type="file" name="file" class="form-control"></input>
                      <span class="text-danger fs-8 mt-1 mx-2">
                        Max file size : 2 mb
                      </span>
                    </div>

                    <!-- Menampilkan foto yang telah diunggah -->
                    @if ($workOrder->photo)
                    <a href="{{ asset('uploads/' . $workOrder->photo) }}" target="blank"><img src="{{ asset('uploads/' . $workOrder->photo) }}" alt="User Photo" width="20%"></a>
                    @else
                    <p>Belum ada foto yang diunggah</p>
                    @endif

                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    </div>
                </div>
            </form>
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
