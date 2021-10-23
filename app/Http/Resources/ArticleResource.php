<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    function setting_() {
        
        $user=auth()->user();
        if($user??false){  
            $this->basket=$user->basket->articles()->find($this->id)??false!=false?true:false;
            $this->favorite=$user->favorite->articles()->find($this->id)??false!=false?true:false;
        }
    }
        
    public $basket=false;
    public $favorite=false;
    
    public function toArray($request)
    {
        
        $this->setting_($this);
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'entity' => $this->entity,
            'price'=> $this->price,
            'basket'=> $this->basket,
            'favorite'=> $this->favorite,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
