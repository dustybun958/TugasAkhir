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
                <td><img src="{{ asset('/storage/products/' . $product->image_path) }}" width="50" height="50" alt="Product Image"></td>
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
@endsection
