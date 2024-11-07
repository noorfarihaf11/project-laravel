<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\Sluggable;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id_komen';
    protected $fillable = ['comments', 'author_id', 'id_post']; 

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'id_post');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id'); 
    }
}
