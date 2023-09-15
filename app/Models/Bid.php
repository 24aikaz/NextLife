<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'bidder_id', 'bid_price', 'bid_time',
    ];

    // A bid belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
