<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizeGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'information',
        'category_id',
        'has_content',
    ];
}
