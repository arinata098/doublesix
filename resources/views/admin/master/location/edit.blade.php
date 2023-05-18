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
            <form action="{{ route('location.update', $location->idLocation) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                    <h4>Update {{ $title }}</h4>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                        <label>Location Name</label>
                        <input type="text" name="location_name" value="{{ $location->locationName }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Location Detail</label>
                      <input type="text" name="location_detail" value="{{ $location->locationDetail }}" class="form-control" required>
                  </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="location_desc" value="{{ $location->description }}" required></textarea>
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
