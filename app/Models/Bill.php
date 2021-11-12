<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable=[
        'created_at',
        'updated_at'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }
    function basket(){
        return $this->hasOne(Basket::class);
    }
    function address() {
        return $this->hasOne(Address::class);
    }
}
