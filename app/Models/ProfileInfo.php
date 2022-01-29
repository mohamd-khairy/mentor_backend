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
        'user',
        'birth_date',
        'phone',
        'interests',
        'gender',
        'country',
        'city'
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

    public $with = ['user' , 'gender' , 'country' , 'city'];

    public $create_data = [
        'users' => ['model' => 'User'],
        'genders' => ['model' => 'Lookup', 'condition' => ['lookup_type_id' => LookupType::Gender]],
        'countries' => ['model' => 'Lookup', 'condition' => ['lookup_type_id' => LookupType::Country]],
        'cities' => ['model' => 'Lookup', 'condition' => ['lookup_type_id' => LookupType::City]],
    ];


    public $create = [
        'select' => [
            ['type' => 'select', 'icon' => 'user-tag', 'data' => 'users', 'data_save_item' => 'id', 'data_display_item' => 'name', 'id' => 'user_id', 'name' => 'user_id'],
            ['type' => 'select', 'icon' => 'user-tag', 'data' => 'genders', 'data_save_item' => 'id', 'data_display_item' => 'name', 'id' => 'gender_id', 'name' => 'gender_id'],
            ['type' => 'select', 'icon' => 'user-tag', 'data' => 'countries', 'data_save_item' => 'id', 'data_display_item' => 'name', 'id' => 'country_id', 'name' => 'country_id'],
            ['type' => 'select', 'icon' => 'user-tag', 'data' => 'cities', 'data_save_item' => 'id', 'data_display_item' => 'name', 'id' => 'city_id', 'name' => 'city_id'],
        ],
        'textarea' => [
            ['type' => 'text', 'icon' => 'user', 'translate' => true, 'id' => 'interests', 'name' => 'interests'],
        ],
        'input' => [
            ['type' => 'number', 'icon' => 'user', 'translate' => false, 'id' => 'phone', 'name' => 'phone'],
        ],
        'date' => [
            ['type' => 'date', 'icon' => 'birthday-cake', 'id' => 'birth_date', 'name' => 'birth_date'],//datetime-local
        ]
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
