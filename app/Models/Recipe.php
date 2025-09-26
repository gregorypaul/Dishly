<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rating;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'ingredients',
        'instructions',
        'image_url',
        'user_id',
        'category',
        'youtube',
        'source',
        'measures',
        'tags',
    ];

    protected $casts = [
        'ingredients'  => 'array',
        'instructions' => 'array',
        'measures'     => 'array',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {   
        return round($this->ratings()->avg('score') ?? 0, 1);
    }

    public function userRating($userId)
    {
        return $this->ratings()->where('user_id', $userId)->value('score');
    }

    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'recipe_tag');
    }
}
