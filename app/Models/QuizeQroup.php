<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizeQroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'information',
        'good_count',
        'category_id',
    ];
}
