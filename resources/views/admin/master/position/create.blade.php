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
                Data created failed..
            </div>
        @endif

      <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
            <form action="{{ route('position.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                    <h4>Create New {{ $title }}</h4>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                        <label>Position Name</label>
                        <input type="text" name="position_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="position_desc" required></textarea>
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
