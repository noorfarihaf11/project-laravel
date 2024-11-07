<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'posts';
    protected $primaryKey = 'id_post';
    protected $fillable = ['title', 'author_id', 'slug', 'body', 'id_category', 'image'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class, 'id_post');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_post');
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
