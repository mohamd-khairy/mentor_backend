<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Lookup extends Model
{
    use HasFactory;
    use HasTranslations;
    use GeneralModel;

    protected $fillable = [
        'name',
        'key',
        'parent_id',
        'lookup_type_id'
    ];

    public $visible = [
        'id',
        'name',
        'key',
        'parent_id',
        'lookup_type_id'
    ];

    public $relations_array = [
        'lookup_type_object' => ['item' => 'lookup_type_id', 'relation_name' => 'lookup_type', 'coulmn' => 'name'],
        'parent_object' => ['item' => 'parent_id', 'relation_name' => 'parent', 'coulmn' => 'name']
    ];

    public $translatable = ['name'];

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
