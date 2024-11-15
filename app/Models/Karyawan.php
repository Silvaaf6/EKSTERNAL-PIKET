<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = ['id', 'id_user', 'nik', 'cover', 'tempat_lahir', 'tgl_lahir', 'agama', 'alamat', 'jenis_kelamin', 'no_telp'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
