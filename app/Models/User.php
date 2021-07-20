<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

use App\Models\{Buyer, Supplier};

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes;
    use Notifiable;
    use HasMediaTrait;

    public $table = 'users';
    // protected $with = ['pembelians'];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $appends = [
        'file_lampiran',
        'photo',
        'video',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'username',
        'password',
        'name',
        'alamat',
        'email',
        'no_tlp',
        'kode',
        'email_verified_at',
        'keterangan',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function baseline()
    {
        return $this->hasOne(BaselineTarget::class, 'nama_user_id');
    }

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'created_by_id');
    }

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'created_by_id');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function jenis_plastiks()
    {
        return $this->belongsToMany(JenisPlastik::class);
    }

    public function buyers()
    {
        return $this->belongsToMany(Buyer::class);
    }

    public function supplier()
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function jenis_usahas()
    {
        return $this->belongsToMany(JenisUsaha::class);
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getFileLampiranAttribute()
    {
        return $this->getMedia('file_lampiran');
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function nama_plastiks()
    {
        return $this->belongsToMany(JenisPlastik::class);
    }

    public function getVideoAttribute()
    {
        return $this->getMedia('video')->last();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin()
    {
        return $this->roles->where('title', '=', 'Admin')->count() > 0;
    }

    public function isUserMonitor()
    {
        return $this->roles->where('title', '=', 'User Monitor')->count() > 0;
    }

    public function isTrilion()
    {
        return $this->username == 'trilion-dhapi';
    }

    public function isMitra()
    {
        return $this->roles->where('title', '=', 'Mitra')->count() > 0;
    }

    public function isSuperAdmin()
    {
        return $this->roles->where('title', '=', 'Super Admin')->count() > 0;
    }

    public function baselineTarget(){
        return $this->hasOne(BaselineTarget::class, 'nama_user_id');
    }

    public function isPabrikan()
    {
        return $this->jenis_usahas->where('nama_usaha', '=', 'Pabrikan')->count() > 0;
        // return $this->jenis_usahas->where('nama_usaha', '=', 'Pabrikan')->count() > 0;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
