<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    protected $fillable = ['kode', 'judul', 'pengarang', 'id_kategori'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriBuku::class, 'id_kategori');
    }

}
