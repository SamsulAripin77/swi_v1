<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class BaselineTarget extends Model
{
    // use SoftDeletes;

    public $table = 'baseline_targets';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function pembelians()
    // {
    //     return $this->hasManyThrough(Pembelian::class, JenisPlastik::class, 'baseline_target_id', 'jenis_plastik_id', 'id', 'id');
    // }

    public function nama_user()
    {
        return $this->belongsTo(User::class, 'nama_user_id');
    }


    public function nama_plastiks()
    {
        return $this->belongsToMany(JenisPlastik::class)->withPivot('baseline', 'target', 'insentif');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
