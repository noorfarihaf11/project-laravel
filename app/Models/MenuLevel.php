<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class MenuLevel extends Model
{
    use HasFactory;

    protected $table = 'menu_levels'; 
    protected $primaryKey = 'id_level';
    protected $fillable = ['level'];
    
    public function menu():HasMany

    {
        return $this->hasMany(Menu::class, 'id_level');
    }
}
