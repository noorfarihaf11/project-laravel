<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $primaryKey = 'menu_id';
    protected $fillable = [
        'menu_name',
        'menu_link',
        'menu_icon',
        'id_level',
        'parent_id',
        'create_by',
        'delete_mark',
        'update_by',
        'update_date'
    ];

    protected $hidden = [
        'delete_mark',
        'update_by',
        'update_date'
    ];

    
    public function hasRole(): BelongsToMany
    {
        return $this->belongsToMany(JenisUser::class, 'menu_users', 'menu_id', 'id_jenis_user');
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(MenuLevel::class, 'id_level');
    }

    public function isAccessibleFor($jenis_user)
    {
        return $this->hasRole()
            ->where('jenis_users.id_jenis_user', $jenis_user->id_jenis_user) // Specify the table
            ->exists();
    }
    

    // public function hasRole(): BelongsTo
    // {
    //     return $this->belongsTo(JenisUser::class, 'menu_users', 'menu_id', 'id_jenis_user');
    // }

}

//     public function menu_user():HasMany

//     {
//         return $this->hasMany(MenuUser::class, 'menu_id');
//     }
// }


   

