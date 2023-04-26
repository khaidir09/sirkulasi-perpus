<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    protected $fillable = [
        'users_id',
        'judul_buku',
        'penerbit',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function setBookAttribute($value)
    {
        $this->attributes['judul_buku'] = Crypt::encrypt($value);
    }

    public function getBookAttribute($value)
    {
        return Crypt::decrypt($value);
    }
}
