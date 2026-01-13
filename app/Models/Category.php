<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    // query semua category
    public static function getAllCategories()
    {
        return Category::orderBy('created_at', 'desc')->get();
    }

    // relasi category one to many report
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
