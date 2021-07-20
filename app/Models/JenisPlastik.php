<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisPlastik extends Model
{
    use SoftDeletes;

    public $table = 'jenis_plastiks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'kategori_plastik_id',
        'nama_plastik',
        'keterangan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function kategori_plastik()
    {
        return $this->belongsTo(KategoriPlastik::class, 'kategori_plastik_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
