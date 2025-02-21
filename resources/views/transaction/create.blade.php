@extends('adminlte.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add Transaction</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Transaction</li>
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
          <form action="{{ route('storeTransaction') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="product_id">Product</label>
              <select class="form-control @error('product_id') is-invalid @enderror" name="product_id" id="product_id">
                <option value="">Select Product</option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                  {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                </option>
                @endforeach
              </select>
              @error('product_id')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Quantity</label>
              <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" placeholder="Enter Quantity" id="quantity">
              @error('quantity')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Customer Name</label>
              <input type="text" class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" value="{{ old('customer_name') }}" placeholder="Enter Customer Name">
              @error('customer_name')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Customer Phone</label>
              <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="Enter Customer Phone">
              @error('customer_phone')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Total Price</label>
              <input type="text" class="form-control" id="total_price" readonly value="Rp 0" disabled>
              <small class="text-muted">Total price will be automatically calculated based on product price and quantity</small>
            </div>

            <button type="submit" class="btn btn-md btn-primary">SAVE</button>
            <button type="reset" class="btn btn-md btn-warning">RESET</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  // Function to format number to Indonesian Rupiah
  function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency'
      , currency: 'IDR'
      , minimumFractionDigits: 0
      , maximumFractionDigits: 0
    }).format(number);
  }

  // Calculate total price when product or quantity changes
  document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity');
    const totalPriceDisplay = document.getElementById('total_price');

    function calculateTotal() {
      const selectedOption = productSelect.options[productSelect.selectedIndex];
      const price = selectedOption ? Number(selectedOption.dataset.price) : 0;
      const quantity = Number(quantityInput.value) || 0;
      const total = price * quantity;

      totalPriceDisplay.value = formatRupiah(total);
    }

    productSelect.addEventListener('change', calculateTotal);
    quantityInput.addEventListener('input', calculateTotal);
  });

</script>

@endsection
