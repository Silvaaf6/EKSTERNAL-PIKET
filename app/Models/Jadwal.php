<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = ['id', 'id_user', 'hari'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
