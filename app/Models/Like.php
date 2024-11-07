<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\Sluggable;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes'; 
    protected $primaryKey = 'id_like';
    protected $fillable = ['id_post','author_id'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'id_post');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id'); 
    }
}
