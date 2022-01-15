<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Lookup extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'name',
        'key',
        'parent_id',
        'lookup_type_id'
    ];

    public $translatable = ['name'];

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

    public function lookup_type()
    {
        return $this->belongsTo(LookupType::class);
    }

    public function parent()
    {
        return $this->belongsTo(Lookup::class, 'parent_id', 'id');
    }

    public function child()
    {
        return $this->hasMany(Lookup::class, 'id', 'parent_id');
    }

    
}
