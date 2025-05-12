<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    protected $table = "blog";
    protected $fillable = [
        'title',
        'description',
        'image',
        'category_id',
        'created_at',
        'updated_at',
    ];
public function category():BelongsTo{
        return $this->belongsTo(blogsCategory::class,'category_id');
    }
}
