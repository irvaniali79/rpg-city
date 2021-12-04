<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

class Role extends Model
{
    use HasFactory;
    static public function boot()
    {
        JsonResource::withoutWrapping();
    }
    protected $visible = ['role'];
    
}
