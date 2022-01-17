<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class LookupType extends Model
{
    use HasFactory;
    use HasTranslations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'key',
    ];

    public $visible = [
        'id',
        'name',
        'key',
    ];

    protected $fillableType = [
        ['item_name' => 'name' , 'item_type' => 'input'],
        ['item_name' => 'key' , 'item_type' => 'input'],
    ];

    protected $casts = [
        'name' => 'array',
    ];
    
    public $translatable = ['name'];

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
