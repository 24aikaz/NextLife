<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'pname',
        'pdesc',
        'image',
        'startprice',
        'currentprice',
        'bidcount',
        'category',
        'startdate',
        'enddate',
        'seller_id',
    ];
    protected $dates = ['startdate', 'enddate','deleted_at'];

    protected $primaryKey = 'Product_ID';

    protected $casts = [
        'status' => 'string', 
    ];

    // A product belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    // A product has many bids
    public function bids()
    {
        return $this->hasMany(Bid::class, 'Product_id', 'product_id');
    }

    // A seller is a user, so a seller belongs to a user
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    // A product features in an Auction
    public function auctions()
    {
        return $this->hasMany(Auction::class, 'Product_ID', 'Product_ID');
    }
}