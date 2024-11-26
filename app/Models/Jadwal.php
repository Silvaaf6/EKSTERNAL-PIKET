<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'id_user', 'hari'];

    public $timestamp = true;
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
