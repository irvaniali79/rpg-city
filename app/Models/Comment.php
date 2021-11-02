<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','email','body','advantages','disadvantages','rate','rate_participant_number','accepted'
    ];
    protected $casts = [
        'disadvantages' => 'json',
        'advantages' => 'json'
    ];
    public function article()
    {
        return $this->hasOne(Article::class);
    }
}
