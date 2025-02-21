<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'total_price',
        'transaction_date',
        'customer_name',
        'customer_phone'
    ];

    public $timestamps = false;

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor untuk format total harga
    public function getTotalPriceFormattedAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }
}
