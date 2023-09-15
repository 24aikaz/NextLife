<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
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
        'categories' => 'enum:user interface,auction experience,payment process,communication,other',
        'feedback_type' => 'enum:suggestion,rating,problem',
        'frequency' => 'enum:once,often,always',
    ];
}
// NOT IN USE