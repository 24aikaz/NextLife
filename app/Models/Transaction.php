<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions'; // Specify the table name if it's different from the model name

    protected $primaryKey = 'Transaction_ID'; // Specify the primary key if it's different from 'id'

    protected $fillable = [
        'Product_ID',
        'Bidder_ID',
        'Seller_ID',
        'Price',
        'Payment_Method',
        'Seller_Address',
        'Bidder_Address',
    ];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID', 'Product_ID');
    }
}
