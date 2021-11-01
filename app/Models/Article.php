<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'id' ,
        'name' ,
        'entity',
        'price',
        'basket',
        'favorite',
        'created_at' ,
        'updated_at' ,
    ];
    function baskets() {
        return $this->belongsToMany(Basket::class);
    }
    function categories(){
        return $this->belongsToMany(Category::class,'article_category','article_id','category_id');
    }
    function media() {
        return $this->hasMany(Media::class);   
    }
}
