<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravelista\Comments\Commenter;
use Illuminate\Contracts\Validation\Rule;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with= [
        'role'
    ];



    function role(){
        return $this->hasOne(Role::class);
    }
    function basket() {
        return $this->hasOne(Basket::class);
    }
    function favorite() {
        return $this->hasOne(Favorite::class);
    }
    function bills() {
        return $this->hasMany(Bill::class);
    }
    function addresses() {
        return $this->hasMany(Address::class);
    }
}
