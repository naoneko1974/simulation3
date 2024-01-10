<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'authority',
        'introduction',
        'staff',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function likes(){
        return $this->belongsToMany(Item::class,'likes');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function sold_items(){
        return $this->belongsToMany(Item::class, 'sold_items');
    }

    public function staffs(){
        return $this->hasMany(Staff::class);
    }

    public function scopeNameSearch($query, $name_keyword){
        if (!empty($name_keyword)) {
            $query->where('name', 'like', '%' . $name_keyword . '%');
        }
    }

}
