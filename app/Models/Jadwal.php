<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'user_id',
        'gudang_id',
        'tanggal_kirim',
        'berat_gabah',
        'kadar_air',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
}
