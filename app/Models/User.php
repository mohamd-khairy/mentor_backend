<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasTranslations;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'mobile',
        'user_name'
    ];

    public $visible = [
        'id',
        'name',
        'email',
        'password',
        'role_id',
        'mobile',
        'user_name'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $appends = ['avatar'];

    public $translatable = ['name'];

    protected $fillableType = [];

    public function getfillableTypes()
    {
        return $this->fillableType;
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, app()->getLocale());
        }
        return $attributes;
    }

    public function role()
    {
        return $this->hasOne(Lookup::class, 'id', 'role_id');
    }

    public function profile()
    {
        return $this->hasOne(ProfileInfo::class);
    }

    public function job()
    {
        return $this->hasOne(JobInfo::class);
    }

    public function photo()
    {
        return $this->hasOne(File::class, 'item_id')->where('type', 'profile');
    }

    public function getAvatarAttribute()
    {
        return $this->photo ? $this->photo->name : null;
    }
}
