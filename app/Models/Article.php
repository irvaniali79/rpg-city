<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Jalali;
use Laravel\Scout\Searchable;
use Laravelista\Comments\Commentable;

class Article extends JalaliDate
{
    use HasFactory,Searchable,Commentable;
 
    
    protected $fillable=[
        'id' ,
        'name' ,
        'entity',
        'price',
        'created_at' ,
        'updated_at' ,
    ];
    

    
    public function searchablesAs(){
        return 'articles';
    }
    
    public function baskets() {
        return $this->belongsToMany(Basket::class);
    }
    
    public function categories(){
        return $this->belongsToMany(Category::class,'article_category','article_id','category_id');
    }
    

    
    public function media() {
        return $this->hasMany(Media::class);   
    }
}
