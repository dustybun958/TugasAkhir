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
          <h1 class="m-0">Categories List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

            <li class="breadcrumb-item active">Categories List</li>
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
          <a href="{{ route('createCategory') }}" class="btn btn-primary" role="button">Add Category</a>
        </div>
        <div class="card-body">
          <table class="table table-hover table-bordered" id="data-table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                  <a href="{{ route('editCategory', ['id'=>$category->id]) }}" class="btn btn-warning btn-sm" role="button">Edit</a>
                  <a onclick="confirmDelete(this)" data-url="{{ route('deleteCategory', ['id' => $category->id]) }}" class="btn btn-danger btn-sm" role="button">Delete</a>
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
