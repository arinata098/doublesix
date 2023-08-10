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
            <form action="{{ route('category.update', $category->idCategory ) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                    <h4>Update {{ $title }}</h4>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="category_name" value="{{ $category->cateName }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Department</label>
                      <select name="idDept" class="form-control select2 @error('idDept') is-invalid @enderror" required>
                        <option value="" selected>Select Department</option>
                            @foreach ($departmentCollection as $department)
                            <option value="{{ $department->idDept }}" @if ($department->idDept == $category->idDept) selected
                                @endif>{{ $department->deptName }}</option>
                            @endforeach
                      </select>
                      @error('idDept')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="category_desc" value="{{ $category->description }}" required></textarea>
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
