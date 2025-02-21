@extends('adminlte.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

            <li class="breadcrumb-item active">Edit Category</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container mt-5">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('updateCategory', ['id' => $category->id]) }}" method="POST">
            @csrf

            <div class="form-group">
              <label for="name">Category Name</label>
              <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name', $category->name) }}" placeholder="Enter category name">
              @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="description">Description</label>
              <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror" required placeholder="Enter category description">{{ old('description', $category->description) }}</textarea>
              @error('description')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="text-right">
              <a href="{{ route('daftarCategory') }}" class="btn btn-outline-secondary mr-2" role="button">Cancel</a>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
