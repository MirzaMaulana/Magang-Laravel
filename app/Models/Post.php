<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use  HasApiTokens, HasFactory, Notifiable, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'created_by',
    ];

    protected $attributes = [
        'image' => ''
    ];
    public function category()
    {
        return $this->belongsToMany(Category::class, "post_category",  "post_id", "categories_id");
    }
    public function tag()
    {
        return $this->belongsToMany(Tags::class, "post_tag", "post_id", "tag_id");
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
