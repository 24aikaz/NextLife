<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions'; 

    protected $primaryKey = 'Transaction_ID'; 

    protected $fillable = [
        'Product_ID',
        'Bidder_ID',
        'Seller_ID',
        'Price',
        'Payment_Method',
        'Seller_Address',
        'Bidder_Address',
    ];

    // A transaction made is related to a specific product
    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID', 'Product_ID');
    }
}
