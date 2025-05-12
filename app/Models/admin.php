<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class admin extends Authenticatable
{
    use HasFactory;
    protected $table = "admin";
    protected $fillable = [
        'email',
        'password',
    ];
    protected $hidden = [
        'password'
    ];
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
