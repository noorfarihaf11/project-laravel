<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'id_user',
        'name',
        'username',
        'email',
        'no_hp',
        'wa',
        'pin',
        'id_jenis_user',
        'status_user',
        'password',
        'is_admin'
    ];
    public $timestamps = false; // Disable automatic timestamps

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
        'delete_mark',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
        'is_admin'
    ];


    public function posts(): HasMany

    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_users', 'id_jenis_user', 'menu_id');
    }

    public function user_activities(): HasMany

    {
        return $this->hasMany(UserActivity::class, 'no_activity');
    }

    public function user_photos(): HasMany

    {
        return $this->hasMany(UserPhoto::class, 'id_user', 'id_user');
    }

    public function hasRole(): BelongsTo
    {
        return $this->belongsTo(JenisUser::class, 'id_jenis_user', 'id_jenis_user');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'author_id', 'id_post');
    } 

}
