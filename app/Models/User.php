<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Jadwal;
use App\Models\Karyawan;
use App\Models\Piket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, hasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_user');
    }

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class, 'id_user');
    }

    public function piket()
    {
        return $this->hasMany(Piket::class, 'id_user');
    }

    public function getProfilePhotoUrlAttribute()
    {
        // Mengambil data karyawan yang terkait dengan user
        $karyawan = $this->karyawan;

        // Jika ada cover di tabel karyawan, gunakan cover tersebut
        return $karyawan && $karyawan->cover
        ? asset('images/karyawan/' . $karyawan->cover)
        : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

}
