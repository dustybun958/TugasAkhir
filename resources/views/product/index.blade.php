@extends('adminlte.layouts.app')
@section('addCss')
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('addJavascript')
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
<script>
  $(function() {
    $('#data-table').DataTable();
  });

</script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script>
  confirmDelete = function(button) {
    var url = $(button).data('url');
    swal({
      'title': 'Konfirmasi Hapus'
      , 'text': 'Apakah Kamu Yakin Ingin Menghapus Data Ini?'
      , 'dangermode': true
      , 'buttons': true
    }).then(function(value) {
      if (value) {
        window.location = url;
      }
    });
  }

</script>

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Product List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Product List</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header text-right">
          <a href="{{route('createProduct')}}" class="btn btn-primary" role="button">Add Product</a>
        </div>
        <div class="card-body">
          <table class="table table-hover table-bordered" id="data-table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Category</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr>
                <td>{{$loop->index+1}}</td>
                <td>
                  <div class="product-image-container">
                    <img src="{{ asset('/storage/products/' . $product->image_path) }}" alt="Product Image" class="product-image" onclick="showImageModal(this.src)">
                  </div>
                </td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->name}}</td>
                <td>{!!$product->description!!}</td>
                <td>{{$product->price_formatted}}</td>
                <td>{{$product->stock}}</td>
                <td>
                  <a href="{{route('editProduct', $product->id)}}" class="btn btn-warning btn-sm" role="button">Edit</a>
                  <a onclick="confirmDelete(this)" data-url="{{route('deleteProduct', $product->id)}}" class="btn btn-danger btn-sm" role="button">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img id="modalImage" src="" alt="Product Image Preview">
      </div>
    </div>
  </div>
</div>

<script>
  function showImageModal(imageSrc) {
    $('#modalImage').attr('src', imageSrc);
    $('#imageModal').modal('show');
  }

  // Optional: Close modal when clicking outside
  $(document).click(function(e) {
    if ($(e.target).is('#imageModal')) {
      $('#imageModal').modal('hide');
    }
  });

</script>

<style>
  .product-image-container {
    width: 50px;
    height: 50px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    cursor: pointer;
  }

  .product-image:hover {
    opacity: 0.8;
    transition: opacity 0.3s ease;
  }

  #imageModal .modal-body {
    padding: 0;
    background-color: #000;
  }

  #modalImage {
    max-width: 100%;
    max-height: 80vh;
    display: block;
    margin: 0 auto;
    object-fit: contain;
  }

  /* Make sure modal is responsive */
  @media (max-width: 768px) {
    .modal-dialog {
      margin: 0.5rem;
    }
  }

</style>


@endsection
