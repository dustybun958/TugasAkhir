@extends('adminlte.layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Transactions</span>
              <span class="info-box-number">{{ $totalTransactions }}</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Revenue</span>
              <span class="info-box-number">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-box"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Products</span>
              <span class="info-box-number">{{ $totalProducts }}</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Customers</span>
              <span class="info-box-number">{{ $totalCustomers }}</span>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <!-- Daily Transactions Chart -->
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Daily Transactions (Last 7 Days)</h3>
            </div>
            <div class="card-body">
              <div id="daily-transactions-chart" style="height: 300px;">
                <script>
                  var dailyData = @json($dailyData);
                  var dailyLabels = @json($dailyLabels);
                  document.addEventListener("DOMContentLoaded", function() {
                    Highcharts.chart("daily-transactions-chart", {
                      chart: {
                        type: "line"
                      }
                      , title: {
                        text: "Daily Transactions (Last 7 Days)"
                      }
                      , xAxis: {
                        categories: dailyLabels
                      }
                      , yAxis: {
                        title: {
                          text: "Number of Transactions"
                        }
                      }
                      , series: [{
                        name: "Transactions"
                        , data: dailyData
                      }]
                    });
                  });

                </script>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <!-- Top Products Chart -->
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Top 5 Products</h3>
            </div>
            <div class="card-body">
              <div id="top-products-chart" style="height: 300px;">
                <div id="top-products-chart" style="height: 300px;">
                  <script>
                    var topProductsLabels = @json($topProductsLabels);
                    var topProductsData = @json($topProductsData);
                    document.addEventListener("DOMContentLoaded", function() {
                      Highcharts.chart("top-products-chart", {
                        chart: {
                          type: 'bar'
                        }
                        , title: {
                          text: 'Top 5 Products'
                        }
                        , xAxis: {
                          categories: topProductsLabels
                        }
                        , yAxis: {
                          title: {
                            text: 'Total Sold'
                          }
                        }
                        , series: [{
                          name: 'Total Sold'
                          , data: topProductsData
                        }]
                      });
                    });

                  </script>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- Latest Transactions -->
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Latest Transactions</h3>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-striped table-valign-middle">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($latestTransactions as $transaction)
                  <tr>
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>{{ $transaction->customer_name }}</td>
                    <td>{{ $transaction->product->name }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@push('styles')
<style>
  .card-body {
    position: relative;
    min-height: 300px;
  }

</style>
@endpush
