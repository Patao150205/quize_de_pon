<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quize extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'question',
        'choice1',
        'choice2',
        'choice3',
        'choice4',
        'correct_choice',
        'explanation',
        'sort_num',
        'user_id',
        'quize_group_id',
    ];

    public function getQuizeCount($quize_group_id)
    {
        $count = $this->where('quize_group_id', $quize_group_id)->count();

        return $count;
    }
}
