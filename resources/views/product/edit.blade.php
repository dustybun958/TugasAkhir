@extends('adminlte.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

            <li class="breadcrumb-item active">Edit Product</li>
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
          <form action="{{ route('updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label for="category_id">Category</label>
              <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $product->name) }}" placeholder="Enter Product Name">
              @error('name')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Description</label>
              <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Enter Product Description">{{ old('description', $product->description) }}</textarea>
              @error('description')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Price</label>
              <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product->price) }}" placeholder="Enter Product Price">
              @error('price')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Stock</label>
              <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock', $product->stock) }}" placeholder="Enter Product Stock">
              @error('stock')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Image</label>
              <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" accept="image/*">
              @error('image')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
              @if($product->image_path)
              <div class="mt-2">
                <small class="text-muted">Current Image:</small>
                <div class="mt-1">
                  <img id="current-image" src="{{ Storage::url('public/products/'.$product->image_path) }}" alt="Current Product Image" class="img-thumbnail" style="max-height: 200px">
                </div>
              </div>
              @endif

              <div class="mt-2" id="image-preview" style="display: none;">
                <small class="text-muted">New Image Preview:</small>
                <div class="mt-1">
                  <img id="new-image" src="" alt="New Product Image" class="img-thumbnail" style="max-height: 200px">
                </div>
              </div>
            </div>


            <a href="{{ route('daftarProduct') }}" class="btn btn-outline-secondary mr-2" role="button">Cancel</a>
            <button type="submit" class="btn btn-md btn-primary">Update</button>
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

</script>
<script>
  document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('image-preview');
    const newImage = document.getElementById('new-image');

    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        newImage.src = e.target.result;
        previewContainer.style.display = 'block'; // Tampilkan pratinjau
      }
      reader.readAsDataURL(file);
    } else {
      previewContainer.style.display = 'none'; // Sembunyikan pratinjau jika tidak ada file
    }
  });

</script>
@endsection
