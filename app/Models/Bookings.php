<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $fillable = [
        'users_id',
        'books_id',
        'nama_anggota',
        'nama_buku',
        'expired',
        'status'
    ];
}
