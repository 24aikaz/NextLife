<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'pname', 'pdesc', 'image', 'startprice', 'currentprice', 'status', 'bidcount',
        'category', 'startdate', 'enddate', 'seller_id',
    ];
    protected $dates = ['startdate', 'enddate'];


    protected $primaryKey = 'Product_ID';

    protected $casts = [
        'status' => 'string', // Cast the status field as string (enum)
    ];

    public function user(){
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

public function bids()
{
    return $this->hasMany(Bid::class, 'product_id');
}

}
