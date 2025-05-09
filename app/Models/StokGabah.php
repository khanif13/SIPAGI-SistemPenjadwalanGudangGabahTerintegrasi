<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokGabah extends Model
{
    protected $fillable = [
        'gudang_id',
        'user_id',
        'tanggal_masuk',
        'berat_gabah',
        'kadar_air'
    ];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
