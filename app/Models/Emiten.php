<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emiten extends Model
{
    use HasFactory;
    protected $primaryKey = 'stock_kode';
    protected $keyType = 'string';
    protected $table = 'emiten';
    protected $fillable = [
        'stock_kode',
        'stock_name',
        'shared',
        'sektor'
    ];
}

