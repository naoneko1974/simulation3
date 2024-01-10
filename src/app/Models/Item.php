<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'price',
        'description',
        'img_url',
        'user_id',
        'condition_id',
    ];

    public function categories(){
        return $this->belongsToMany(Category::class,'category_item');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function condition(){
        return $this->belongsTo(Condition::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function sold_items(){
        return $this->hasMany(Sold_item::class);
    }

    public function scopeNameSearch($query, $name_keyword){
        if (!empty($name_keyword)) {
            $query->where('name', 'like', '%' . $name_keyword . '%');
        }
    }

}
