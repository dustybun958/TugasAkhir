<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('no.cache');
    }
    public function index()
    {
        $transactions = Transaction::with('product')->get();
        return view('transaction.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('transaction.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|min:3',
            'customer_phone' => 'required|min:10'
        ]);

        // Get product
        $product = Product::findOrFail($request->product_id);

        // Calculate total price
        $total_price = $product->price * $request->quantity;

        // Create transaction
        Transaction::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'transaction_date' => now(),
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone
        ]);

        // Redirect to index
        return redirect(route('daftarTransaction'))->with('success', 'Transaction successfully created');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Transaction $transaction)
    // {
    //     return view('transactions.show', ['transaction' => $transaction]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $products = Product::all();
        return view('transaction.edit', [
            'transaction' => $transaction,
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate form
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|min:3',
            'customer_phone' => 'required|min:10'
        ]);

        // Get transaction
        $transaction = Transaction::findOrFail($id);

        // Get product
        $product = Product::findOrFail($request->product_id);

        // Calculate total price
        $total_price = $product->price * $request->quantity;

        // Update transaction
        $transaction->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone
        ]);

        // Redirect to index
        return redirect(route('daftarTransaction'))->with('success', 'Transaction successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect(route('daftarTransaction'))->with('success', 'Transaction successfully deleted');
    }
}
