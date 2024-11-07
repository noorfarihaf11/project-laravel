<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class MenuUser extends Model
{
    use HasFactory;
    protected $table = 'menu_users';
    protected $primaryKey = 'no_seting';
    protected $fillable = ['id_jenis_user', 'menu_id', 'checked'];

    protected $hidden = [
        'delete_mark',
        'update_by',
        'update_date'
    ];

    public function hasRole(): BelongsTo
    {
        return $this->belongsTo(JenisUser::class, 'id_jenis_user');
    }


    public function menus(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function isAccessibleFor($jenis_user)
    {
        return $this->hasRole->id_jenis_user === $jenis_user->id_jenis_user;
    }
}
