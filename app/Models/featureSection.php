<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class featureSection extends Model
{
    protected $table = "feature_section";
    protected $fillable = [
        'title',
        'description',
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';
}
