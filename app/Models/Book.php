<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'judul',
        'nomor_induk',
        'jumlah',
        'ketersediaan',
        'publishers_id',
        'classifications_id',
        'tahun_terbit',
        'asal',
        'harga',
        'pengarang'
    ];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publishers_id', 'id');
    }

    public function classification()
    {
        return $this->belongsTo(Classification::class, 'classifications_id', 'id');
    }

    public function loan()
    {
        return $this->hasMany(Loan::class, 'books_id', 'id')
            ->where('status', 'Belum Dikembalikan');
    }
}
