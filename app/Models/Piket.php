<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piket extends Model
{
    protected $fillable = ['id', 'id_user', 'jam_mulai', 'jam_berakhir', 'keterangan'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
