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
    use GeneralModel;

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
        'mobile',
        'user_name',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = ['email_verified_at' => 'datetime'];

    public $translatable = ['name'];

    public $with = ['photo'];

    public $relations_array = [
        'role_object' => ['item' => 'role_id', 'relation_name' => 'role', 'coulmn' => 'name'],
        'photo_object' => ['item' => null, 'relation_name' => 'photo', 'coulmn' => 'name']
    ];

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
}
