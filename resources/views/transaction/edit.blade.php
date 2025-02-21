@extends('adminlte.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Transaction</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Transaction</li>
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
          <form action="{{ route('updateTransaction', $transaction->id) }}" method="POST">
            @csrf

            <div class="form-group">
              <label for="product_id">Product</label>
              <select class="form-control @error('product_id') is-invalid @enderror" name="product_id" id="product_id">
                @foreach ($products as $product)
                <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ old('product_id', $transaction->product_id) == $product->id ? 'selected' : '' }}>
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
              <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" value="{{ old('quantity', $transaction->quantity) }}" placeholder="Enter Quantity">
              @error('quantity')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Customer Name</label>
              <input type="text" class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" value="{{ old('customer_name', $transaction->customer_name) }}" placeholder="Enter Customer Name">
              @error('customer_name')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Customer Phone</label>
              <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" name="customer_phone" value="{{ old('customer_phone', $transaction->customer_phone) }}" placeholder="Enter Customer Phone">
              @error('customer_phone')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label class="font-weight-bold">Total Price</label>
              <input type="text" class="form-control" id="total_price" readonly>
              <small class="text-muted">Total price will be automatically calculated based on product price and quantity</small>
            </div>

            <a href="{{ route('daftarTransaction') }}" class="btn btn-outline-secondary mr-2" role="button">Cancel</a>
            <button type="submit" class="btn btn-md btn-primary">Update</button>
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

    // Add event listeners
    productSelect.addEventListener('change', calculateTotal);
    quantityInput.addEventListener('input', calculateTotal);

    // Calculate initial total
    calculateTotal();
  });

</script>


@endsection
