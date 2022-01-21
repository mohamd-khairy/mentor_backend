<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProfileInfo extends Model
{
    use HasFactory;
    use HasTranslations;
    use GeneralModel;

    protected $fillable = [
        'user_id',
        'birth_date',
        'phone',
        'interests',
        'gender_id',
        'country_id',
        'city_id'
    ];

    public $selected = [
        'id',
        'user_id',
        'birth_date',
        'phone',
        'interests',
        'gender_id',
        'country_id',
        'city_id'
    ];
    
    public $translatable = [
        'interests',
    ];

    public $relations_array = [
        'gender_object' => ['item' => 'gender_id', 'relation_name' => 'gender', 'coulmn' => 'name'],
        'country_object' => ['item' => 'country_id', 'relation_name' => 'country', 'coulmn' => 'name'],
        'city_object' => ['item' => 'city_id', 'relation_name' => 'city', 'coulmn' => 'name'],
        'user_object' => ['item' => 'user_id', 'relation_name' => 'user', 'coulmn' => 'name'],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gender()
    {
        return $this->hasOne(Lookup::class, 'id', 'gender_id');
    }

    public function country()
    {
        return $this->hasOne(Lookup::class, 'id', 'country_id');
    }

    public function city()
    {
        return $this->hasOne(Lookup::class, 'id', 'city_id');
    }
}
