<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'pname', 'pdesc', 'name', 'startprice', 'currentprice', 'status', 'category', 'seller'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'seller', 'id');
    }

}
