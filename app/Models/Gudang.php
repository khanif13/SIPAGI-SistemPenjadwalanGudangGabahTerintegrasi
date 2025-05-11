<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $fillable = ['nama_gudang', 'kapasitas'];


    public function jadwals()
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

    public function getIsiGabahAttribute()
    {
        return $this->stokGabahs()->sum('berat_gabah');
    }
}
