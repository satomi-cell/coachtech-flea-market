<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'brand',
        'price',
        'description',
        'condition',
        'image',
        'is_sold',
    ];

    // 出品者
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // いいねしたユーザー
    public function likeUsers()
    {
        return $this->belongsToMany(User::class, 'likes')
        ->withTimestamps();
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }
    
    public function getIsSoldAttribute()
    {
        return $this->purchase()->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}
