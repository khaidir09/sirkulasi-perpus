<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookings extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id',
        'books_id',
        'nama_anggota',
        'judul_buku',
        'expired',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
