<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;
    protected $fillable = [
        'sellername',
        'Winner_ID',
        'Product_ID',
        'Win_Price',
        'Start_Date',
        'End_Date',
    ];

    // A product in auction has many bids
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
