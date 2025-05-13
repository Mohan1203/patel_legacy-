<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class blogsCategory extends Model
{
    protected $table = "blog_category";
    protected $fillable = [
        'name',
        'description',
    ];

    public function blogs(): HasMany{
        return $this->hasMany(blogs::class,'category_id');
    }

    protected static function booted()
    {
        static::deleting(function ($category) {
            $category->blogs()->delete(); 
        });
    }
}
