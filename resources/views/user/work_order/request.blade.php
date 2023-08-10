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
            <form action="{{ route('wo.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                    <h4>Create New {{ $title }}</h4>
                    </div>
                    <div class="card-body">

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Date</label>
                            <input type="date" readonly class="form-control @error('startWorkOrder') is-invalid @enderror" name="startWorkOrder" id="tanggal" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Request By</label>
                            <input type="text" disabled class="form-control" value="{{ Auth::user()->name }}" required>
                        </div>
                      </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control @error('workOrderName') is-invalid @enderror" name="workOrderName" value="{{ old('workOrderName') }}" required>
                        @error('workOrderName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="idCategory" class="form-control select2 @error('idCategory') is-invalid @enderror" required>
                            <option value="" selected>Select Category</option>
                                @foreach ($categoryCollection as $category)
                                <option value="{{ $category->idCategory }}" data-department="{{ $category->department->idDept }}" @if ($category->idCategory == old('category')) selected
                                    @endif>{{ $category->cateName }}</option>
                                @endforeach
                        </select>
                        @error('idCategory')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-6">
                        <label>From Department</label>
                        <select class="form-control select2" disabled required>
                              @foreach ($departmentCollection as $department)
                              <option value="{{ $department->idDept }}" @if ($department->idDept == Auth::user()->idDept) selected
                                  @endif>{{ $department->deptName }}</option>
                              @endforeach
                        </select>
                        @error('fromDept')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group col-lg-6">
                        <label>To Department</label>

                        <select name="toDept" class="form-control select2" disabled required>
                          <option value="" selected>Select Department</option>
                              @foreach ($departmentCollection as $department)
                              <option value="{{ $department->idDept }}" @if ($department->idDept == old('toDept')) selected
                                  @endif>{{ $department->deptName }}</option>
                              @endforeach
                        </select>
                        @error('toDept')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                        <script>
                            const categorySelect = document.querySelector('select[name="idCategory"]');
                            const toDeptSelect = document.querySelector('select[name="toDept"]');
                        
                            categorySelect.addEventListener('change', (event) => {
                                const selectedOption = event.target.options[event.target.selectedIndex];
                                const departmentId = selectedOption.getAttribute('data-department');
                        
                                // Mengaktifkan dropdown "To Department"
                                toDeptSelect.removeAttribute('disabled');
                        
                                // Memilih opsi yang sesuai di dropdown "To Department"
                                const departmentOptions = toDeptSelect.options;
                                for (const option of departmentOptions) {
                                    if (option.value === departmentId) {
                                        option.selected = true;
                                    }
                                }
                            });
                        </script>
                      </div>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <select name="idLocation" class="form-control select2 @error('idLocation') is-invalid @enderror" required>
                            <option value="" selected>Select Location</option>
                                @foreach ($locationCollection as $location)
                                <option value="{{ $location->idLocation }}" data-description="{{ $location->description }}" @if ($location->idLocation == old('location')) selected
                                    @endif>{{ $location->locationName }}</option>
                                @endforeach
                        </select>
                        @error('idLocation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <textarea id="locationDescriptionTextarea" placeholder="Location Description" class="form-control" name="description" disabled></textarea>
                        <script>
                            const selectElement = document.querySelector('select[name="idLocation"]');
                            const textareaElement = document.getElementById('locationDescriptionTextarea');
                        
                            selectElement.addEventListener('change', (event) => {
                                const selectedOption = event.target.options[event.target.selectedIndex];
                                const description = selectedOption.getAttribute('data-description');
                                textareaElement.value = description;
                            });
                        
                            // Inisialisasi nilai textarea saat halaman pertama kali dimuat
                            const initialOption = selectElement.options[selectElement.selectedIndex];
                            const initialDescription = initialOption.getAttribute('data-description');
                            textareaElement.value = initialDescription;
                        </script>
                    </div>
                    {{-- <div class="form-group">
                        <label>Hourly Estimate</label>
                        <input type="number" id="estimate_hours" pattern="[0-9]" class="form-control @error('estimate') is-invalid @enderror" name="estimate" value="{{ old('estimate') }}" required>
                        @error('estimate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" hidden>
                        <input type="number" readonly class="form-control @error('userId') is-invalid @enderror" name="userId" value="{{ Auth::user()->id }}" required>
                        <select name="fromDept" class="form-control select2 @error('fromDept') is-invalid @enderror" required>
                                <option value="{{ Auth::user()->idDept }}" >{{ Auth::user()->idDept }}</option>
                        </select>
                    </div>

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
