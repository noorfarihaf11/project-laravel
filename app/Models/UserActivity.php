<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UserActivity extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_activity';
    protected $fillable = [
        'id_user', 'description', 'status', 'timestamps'
    ];

    protected $hidden = [
        'delete_mark'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
