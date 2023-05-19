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

        @if (\Session::has('updateFailed'))
            <div class="alert alert-danger">
                Data update failed..
            </div>
        @endif

      <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                <div class="card">
                  <div class="card-header">
                  <h4>Update {{ $title }}</h4>
                  </div>
                  <div class="card-body">
                  <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ $user->name }}" required>
                      @error('user_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label>Level User</label>
                    <select name="user_level" class="form-control select2 @error('user_level') is-invalid @enderror" required>
                      @if ($user->is_admin = 1)
                      <option value="1" selected>Admin</option>
                      <option value="0">Oprational</option>
                      @else
                      <option value="1">Admin</option>
                      <option value="0" selected>Oprational</option>
                      @endif
                    </select>
                      @error('user_level')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label>Position</label>
                      <select name="user_position" class="form-control select2 @error('user_position') is-invalid @enderror" required>
                        <option value="" selected>Select Position</option>
                            @foreach ($positionCollection as $position)
                            <option value="{{ $position->idPosition }}" @if ($position->idPosition == $user->idPosition) selected
                                @endif>{{ $position->positionName }}</option>
                            @endforeach
                      </select>
                      @error('user_position')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label>Department</label>
                      <select name="user_department" class="form-control select2 @error('user_department') is-invalid @enderror" required>
                        <option value="" selected>Select Department</option>
                            @foreach ($departmentCollection as $department)
                            <option value="{{ $department->idDept }}" @if ($department->idDept == $user->idDept) selected
                                @endif>{{ $department->deptName }}</option>
                            @endforeach
                      </select>
                      @error('user_department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="control-label">User Activation</div>
                    <label class="custom-switch mt-2">
                      <input type="checkbox" name="user_status" class="custom-switch-input" @if ($user->status == 1) checked
                      @endif>
                      <span class="custom-switch-indicator"></span>
                      <span class="custom-switch-description">I agree with terms and conditions</span>
                    </label>
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
  </section>
@endsection
