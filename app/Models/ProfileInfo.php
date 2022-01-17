<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProfileInfo extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'user_id',
        'birth_date',
        'phone',
        'interests',
        'gender_id',
        'country_id',
        'city_id'
    ];

    public $visible = [
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
}
