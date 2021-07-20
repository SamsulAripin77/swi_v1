<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Pembelian extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'pembelians';

    protected $with = ['nama_plastiks'];

    protected $appends = [
        'photo_manifes',
        'photo',
        'video',
    ];

    protected $dates = [
        'tgl_beli',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tgl_beli',
        'nama_supplier_id',
        'total_berat',
        'harga',
        'total_harga',
        'konfirmasi',
        'status_plastik',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getTglBeliAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglBeliAttribute($value)
    {
        $this->attributes['tgl_beli'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function nama_supplier()
    {
        return $this->belongsTo(Supplier::class, 'nama_supplier_id');
    }

    public function nama_plastiks()
    {
        return $this->belongsToMany(JenisPlastik::class)->withPivot('berat');
    }

    // public function jenis_plastiks()
    // {
    //     return $this->hasMany(JenisPlastik::class)->withPivot('berat');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getPhotoManifesAttribute()
    {
        $files = $this->getMedia('photo_manifes');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function getPhotoAttribute()
    {
        $files = $this->getMedia('photo');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files ? $files : null;
    }

    public function getVideoAttribute()
    {
        return $this->getMedia('video')->last();
    }
    
}
