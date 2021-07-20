<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyer extends Model
{
    use SoftDeletes;

    public $table = 'buyers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_buyer',
        'jenis_usaha_id',
        'alamat',
        'no_telp',
        'lokasi_sumber_sampah',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function jenis_usaha()
    {
        return $this->belongsTo(JenisUsaha::class, 'jenis_usaha_id');
    }

    public function jenis_plastiks()
    {
        return $this->belongsToMany(JenisPlastik::class);
    }

    public function sumber_sampahs()
    {
        return $this->belongsToMany(SumberSampah::class);
    }

    public function id_users()
    {
        return $this->belongsToMany(User::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
