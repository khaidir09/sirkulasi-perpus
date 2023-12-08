<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kode'
    ];

    public function classification()
    {
        return $this->hasMany(Book::class, 'classifications_id', 'id');
    }
}
