<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    protected $fillable = ['id', 'id_user', 'nik', 'cover', 'tempat_lahir', 'tgl_lahir', 'agama', 'alamat', 'jenis_kelamin', 'no_telp'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function deleteImage()
    {
        if ($this->cover && file_exists(public_path('images/karyawan/' . $this->cover))) {
            return unlink(public_path('images/karyawan/' . $this->cover));
        }
    }
}

