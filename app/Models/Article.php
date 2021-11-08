<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Jalali;

class Article extends JalaliDate
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
    function comments(){
        return $this->hasMany(Comment::class);
    }
    function media() {
        return $this->hasMany(Media::class);   
    }
}
