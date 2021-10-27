<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    
    function user() {
        return $this->belongsTo(User::class);
    }
    function basket(){
        return $this->hasOne(Basket::class);
    }
}
