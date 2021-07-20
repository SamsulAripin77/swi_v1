<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Kemitraan extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $appends = [
        'photo',
        'video',
    ];
    protected $fillable = [
                            'tgl_beli',
                            'nama_mitra',
                            'total_berat',
                            'menyetujui'];
                            
    public function jenis_plastiks()
    {
        return $this->belongsToMany(JenisPlastik::class);
    }

    public function nama_mitras()
    {
        return $this->belongsTo(DataMitra::class,'nama_mitra');
    }

    public function nama_users()
    {
        return $this->belongsToMany(User::class);
    }

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

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo');
        $file->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $file;
    }

    public function getVideoAttribute()
    {
        return $this->getMedia('video')->last();
    }


}
