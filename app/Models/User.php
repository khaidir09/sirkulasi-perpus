<?php

namespace App\Models;

use App\Models\ClassRoom;
use App\Models\Competency;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'class_rooms_id',
        'competencies_id',
        'nisn',
        'nomor_hp',
        'alamat',
        'tempat_lahir',
        'tgl_lahir',
        'nama_ibu',
        'nomor_hp_ortu',
        'perjanjian',
        'status',
        'created_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function competency()
    {
        return $this->belongsTo(Competency::class, 'competencies_id', 'id');
    }

    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_rooms_id', 'id');
    }
}
