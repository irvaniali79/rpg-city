<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'id',
        'created_at',
        'updated_at',
        'user_id'
    ];
    
    
    function articles() {
        return $this->belongsToMany(Article::class);
    }
    
}
