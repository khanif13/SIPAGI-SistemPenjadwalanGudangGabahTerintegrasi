<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $fillable = ['nama_gudang', 'kapasitas'];


    public function penjadwalans()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function stokGabahs()
    {
        return $this->hasMany(StokGabah::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'gudang_user')
            ->withPivot('role_id')
            ->withTimestamps();
    }
}
