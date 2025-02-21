<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('no.cache');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            // Total Transactions
            $totalTransactions = Transaction::count();

            // Total Revenue
            $totalRevenue = Transaction::sum('total_price');

            // Total Products
            $totalProducts = Product::count();

            // Total Unique Customers
            $totalCustomers = Transaction::distinct('customer_name')->count('customer_name');

            // Daily Transactions (Last 7 Days)
            $endDate = Carbon::today()->endOfDay();
            $startDate = Carbon::today()->subDays(6)->startOfDay();

            // Menyiapkan array untuk 7 hari terakhir
            $dailyLabels = [];
            $dailyData = [];

            // Generate data untuk setiap hari
            for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
                $dailyLabels[] = $date->format('d M');

                $count = Transaction::whereDate('transaction_date', $date->format('Y-m-d'))->count();
                $dailyData[] = $count;
            }

            // Top 5 Products
            $topProducts = Transaction::select(
                'products.name',
                DB::raw('SUM(transactions.quantity) as total_sold')
            )
                ->join('products', 'transactions.product_id', '=', 'products.id')
                ->groupBy('products.id', 'products.name')
                ->orderByDesc('total_sold')
                ->limit(5)
                ->get();

            $topProductsLabels = $topProducts->pluck('name')->toArray();
            $topProductsData = $topProducts->pluck('total_sold')->map(function ($item) {
                return (int)$item; // Convert to integer
            })->toArray();

            // Latest 10 Transactions
            $latestTransactions = Transaction::with('product')
                ->orderByDesc('transaction_date')
                ->limit(10)
                ->get();

            // Debug data
            Log::info('Dashboard Data', [
                'dailyLabels' => $dailyLabels,
                'dailyData' => $dailyData,
                'topProductsLabels' => $topProductsLabels,
                'topProductsData' => $topProductsData
            ]);

            // Pastikan data tidak kosong
            if (empty($dailyData) || empty($topProductsData)) {
                Log::warning('Dashboard data is empty');
            }
            // Cek jika tidak ada transaksi dalam 7 hari terakhir
            if (count($dailyData) === 0) {
                $dailyData = array_fill(0, 7, 0); // Isi dengan 0 jika kosong
            }

            // Cek jika tidak ada produk terjual
            if (count($topProductsData) === 0) {
                $topProductsLabels = ["No Data"];
                $topProductsData = [0];
            }


            return view('home', compact(
                'totalTransactions',
                'totalRevenue',
                'totalProducts',
                'totalCustomers',
                'dailyLabels',
                'dailyData',
                'topProductsLabels',
                'topProductsData',
                'latestTransactions'
            ));
        } catch (\Exception $e) {
            Log::error('Dashboard Error: ' . $e->getMessage());
            return view('home')->with('error', 'Terjadi kesalahan dalam memuat dashboard.');
        }
    }
}
