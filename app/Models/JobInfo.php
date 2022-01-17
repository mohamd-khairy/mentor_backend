<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class JobInfo extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'user_id',
        'job_title',
        'bio',
        'topics',
        'company',
        'facebook',
        'twitter',
        'github',
        'linkedin',
        'youtube',
        'instagram',
        'website',
        'other',
    ];

    public $with = ['cv'];

    public $translatable = [
        'job_title',
        'bio',
        'topics',
        'company',
    ];

    public $visible = [
        'id',
        'user_id',
        'job_title',
        'topics',
        'company',
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

    public function cv()
    {
        return $this->hasOne(File::class, 'item_id')->where('type', 'cv');
    }
}
