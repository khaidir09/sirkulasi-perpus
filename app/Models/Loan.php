<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id',
        'books_id',
        'status',
        'foto_bukti',
        'kuantitas',
        'created_at',
        'tgl_pengembalian'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'books_id', 'id');
    }
}
