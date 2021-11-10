<?php
namespace app\Models;

use App\Casts\Jalali;
use Illuminate\Database\Eloquent\Model;

class JalaliDate extends Model
{
    protected $casts=[
        'created_at'=> Jalali::class,
        'updated_at'=> Jalali::class
    ];
}

