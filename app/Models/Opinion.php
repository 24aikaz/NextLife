<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'feedback_type',
        'categories',
        'stars',
        'frequency',
        'comment',
    ];

    protected $casts = [
        'categories' => 'string',
        'feedback_type' => 'string',
        'frequency' => 'string',
    ];
}
