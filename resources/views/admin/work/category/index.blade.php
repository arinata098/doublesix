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
    <h2 class="section-title">{{ $section }}</h2>
    <p class="section-lead">
      {{ $desc }}
    </p>
    @if (\Session::has('createSuccess'))
            <div class="alert alert-info">
              Data created successfully..
            </div>
    @endif
    @if (\Session::has('successDelete'))
            <div class="alert alert-info">
              Data delete successfully..
            </div>
    @endif
    @if (\Session::has('successUpdate'))
            <div class="alert alert-info">
              Data Update successfully..
            </div>
    @endif
    @if (\Session::has('errorDelete'))
            <div class="alert alert-danger">
              Data delete failed..
            </div>
    @endif
    @if (\Session::has('errorDatanotfound'))
            <div class="alert alert-danger">
              Data not found..
            </div>
    @endif

    <div class="row">
      <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>{{ $title }}</h4>
            <div class="card-header-action">
              <a href="{{ route('category.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Create New</a>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped mb-0">
                <thead>
                  <tr>
                    <th>Category Name</th>
                    <th>Department Section</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                  <tr>
                    <td>{{ $category->cateName }}</td>
                    <td>{{ $category->department->deptName }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                      <a href="{{ route('category.edit', $category->idCategory) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                      <form action="{{ route('category.destroy', $category->idCategory ) }}" method="POST"
                        class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" data-toggle="tooltip" data-original-title="Hapus bagian"
                            class="btn btn-danger btn-action"
                            onclick="return confirm('Are you sure you want to delete {{ $category->cateName }}?');"><i class="fas fa-trash"></i></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="d-flex justify-content-end mr-3 mt-3">
                {{ $categories->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
