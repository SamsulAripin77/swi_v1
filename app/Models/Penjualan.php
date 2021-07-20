<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Penjualan extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'penjualans';

    protected $with = (['user:id,name']);

    protected $appends = [
        'photo_manifes',
        'photo',
        'video',
    ];

    protected $dates = [
        'tgl_jual',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tgl_jual',
        'nama_buyer_id',
        'total_berat',
        'harga',
        'total_harga',
        'konfirmasi',
        'deskripsi',
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

    public function getTglJualAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglJualAttribute($value)
    {
        $this->attributes['tgl_jual'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function nama_buyer()
    {
        return $this->belongsTo(Buyer::class, 'nama_buyer_id');
    }

    public function nama_plastiks()
    {
        return $this->belongsToMany(JenisPlastik::class)->withPivot('berat');
    }

    public function plastik_olahan()
    {
        return $this->belongsToMany(JenisPlastik::class)->where('nama_plastik', '=', 'produk hasil olahan');
    }
    public function plastik_non_olahan()
    {
        return $this->belongsToMany(JenisPlastik::class)->where('nama_plastik', '!=', 'produk hasil olahan');
    }


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

        return $files;
    }

    public function getVideoAttribute()
    {
        return $this->getMedia('video')->last();
    }
}
