<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataMitra extends Model
{
    protected $fillable = ['nama_mitra','alamat','no_hp','lokasi_sampah'];

    public function jenis_usahas()
    {
        return $this->belongsToMany(JenisUsaha::class);
    }

    public function jenis_plastiks()
    {
        return $this->belongsToMany(JenisPlastik::class);
    }

    public function sumber_sampahs()
    {
        return $this->belongsToMany(SumberSampah::class);
    }

    public function nama_users()
    {
        return $this->belongsToMany(User::class);
    }
}
