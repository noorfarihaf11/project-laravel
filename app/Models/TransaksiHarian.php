<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiHarian extends Model
{
    use HasFactory; 
    protected $primaryKey = 'no_record';
    protected $table = 'transaksi_harian';
    protected $fillable = [
        'no_record',
        'stock_kode',
        'date_transaction',
        'open',
        'high',
        'low',
        'close',
        'change',
        'volume',
        'value',
        'frequency'

];

    public function hasEmiten(): BelongsTo
    {
        
        return $this->belongsTo(Emiten::class, 'stock_kode', 'stock_kode');
    }
}
