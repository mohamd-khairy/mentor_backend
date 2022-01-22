<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasTranslations;
    use GeneralModel;

    protected $table = "users";

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'mobile',
        'user_name'
    ];

    public $selected = [
        'id',
        'name',
        'email',
        'mobile',
        'user_name',
        'role',
        'photo'
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
        'photo_object' => ['item' => null, 'relation_name' => 'photo', 'coulmn' => 'img']
    ];

    public $create_data = [
        'roles' => ['model' => 'Lookup', 'condition' => ['lookup_type_id' => LookupType::Role]]
    ];

    public $create = [
        'input' => [
            ['type' => 'text', 'icon' => 'user', 'translate' => true, 'id' => 'name', 'name' => 'name'],
            ['type' => 'text', 'icon' => 'user', 'translate' => false, 'id' => 'user_name', 'name' => 'user_name'],
            ['type' => 'email', 'icon' => 'envelope', 'translate' => false, 'id' => 'email', 'name' => 'email'],
            ['type' => 'password', 'icon' => 'key', 'translate' => false, 'id' => 'password', 'name' => 'password'],
            ['type' => 'number', 'icon' => 'phone', 'translate' => false, 'id' => 'mobile', 'name' => 'mobile'],

        ],
        'select' => [
            ['type' => 'select', 'icon' => 'user-tag', 'data' => 'roles', 'data_save_item' => 'id', 'data_display_item' => 'name', 'id' => 'name', 'name' => 'role_id'],
        ],
        'image' => [
            ['type' => 'image', 'icon' => 'image', 'id' => 'image', 'name' => 'image'],
        ],
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
