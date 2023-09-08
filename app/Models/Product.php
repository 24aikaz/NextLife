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
        'status' => 'string', // Cast the status field as string (enum)
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'Product_id', 'product_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class, 'Product_ID', 'Product_ID');
    }
}