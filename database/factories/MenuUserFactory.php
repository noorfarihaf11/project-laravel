<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuUser extends Model
{
    use HasFactory;

    protected $table = 'menu_user'; 
    protected $primaryKey = 'no_seting';


    protected $hidden = [
        'create_time',
        'delete_mark',
        'create_by',
        'create_date',
        'delete_mark',
        'update_by',
        'update_date'
    ];

    
    public function menuUser(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}