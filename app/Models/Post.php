<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use  HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'title',
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
}
