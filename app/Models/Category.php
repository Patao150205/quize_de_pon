<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function searchCategoryInfo($category_name)
    {
        $category = DB::table('categories')
            ->select('id', 'name_jp')
            ->where('name', '=', $category_name)
            ->first();
        if (empty($category)) {
            abort('404');
        }

        return $category;
    }
}
