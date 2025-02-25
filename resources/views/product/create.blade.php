@extends('adminlte.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Add Product</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container mt-5">
      <div class="card border-0 shadow-sm rounded">
        <div class="card-body">
          <form action="{{ route('storeProduct') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="category_id">Category</label>
              <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
                @endforeach
              </select>
              @error('category_id')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Product Name">
              @error('name')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Description</label>
              <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Product Description">{{ old('description') }}</textarea>
              @error('description')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Price</label>
              <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="Enter Product Price" min="0" step="0.01" required>
              @error('price')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Stock</label>
              <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" placeholder="Enter Product Stock" min="0" required>
              @error('stock')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Image</label>
              <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" onchange="previewImage()">
              @error('image')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
              <!-- Image Preview -->
              <div class="mt-3">
                <img id="imagePreview" src="#" alt="Preview" style="max-width: 200px; display: none;" class="img-thumbnail">
              </div>
            </div>

            <button type="submit" class="btn btn-md btn-primary">SAVE</button>
            <button type="reset" class="btn btn-md btn-warning" onclick="resetImage()">RESET</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('description');

  // Function to preview image before upload
  function previewImage() {
    const image = document.querySelector('#image');
    const imagePreview = document.querySelector('#imagePreview');

    imagePreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
      imagePreview.src = oFREvent.target.result;
    }
  }

  // Function to reset image preview
  function resetImage() {
    const imagePreview = document.querySelector('#imagePreview');
    imagePreview.src = '#';
    imagePreview.style.display = 'none';
  }

</script>

@endsection
