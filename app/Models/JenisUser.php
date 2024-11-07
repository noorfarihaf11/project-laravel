<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class JenisUser extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_jenis_user';
    protected $table = 'jenis_users';
    protected $fillable = ['name'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_jenis_user', 'id_jenis_user');
    }
    

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_users', 'id_jenis_user', 'menu_id');
    }
}
