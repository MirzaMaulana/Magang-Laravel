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
        'is_pinned',
        'created_by',
    ];

    protected $attributes = [
        'image' => '',
        'is_pinned' => ''
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when(isset($filters['category']), function ($query) use ($filters) {
            $query->whereHas('category', function ($query) use ($filters) {
                $query->where('name', $filters['category']);
            });
        });

        $query->when(isset($filters['tag']), function ($query) use ($filters) {
            $query->whereHas('tag', function ($query) use ($filters) {
                $query->where('name', $filters['tag']);
            });
        });
    }
    public function category()
    {
        return $this->belongsToMany(Category::class, "post_category",  "post_id", "categories_id");
    }
    public function tag()
    {
        return $this->belongsToMany(Tags::class, "post_tag", "post_id", "tag_id");
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
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
