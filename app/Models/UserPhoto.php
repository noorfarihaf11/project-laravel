<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPhoto extends Model
{
    use HasFactory;
    protected $primaryKey = 'no_foto';
    protected $fillable = ['id_user', 'image'];

    public function user_photos():BelongsTo

    {
        return $this->belongsTo(User::class);
    }
}
