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
        'price',
        'description',
        'image',
        'is_sold',
    ];

    // 出品者
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
