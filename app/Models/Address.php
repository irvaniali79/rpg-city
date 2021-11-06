<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable=[
        'address',
        'discription',
        'name',
        'region',
        'city',
        'phone',
        'zip_code',
        'status'
    ];
}
