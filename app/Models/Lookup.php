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

    public $selected = [
        'id',
        'name',
        'key',
        'parent',
        'lookup_type'
    ];

    public $relations_array = [
        'lookup_type_object' => ['item' => 'lookup_type_id', 'relation_name' => 'lookup_type', 'coulmn' => 'name'],
        'parent_object' => ['item' => 'parent_id', 'relation_name' => 'parent', 'coulmn' => 'name']
    ];

    public $translatable = ['name'];

    public $with = ['lookup_type' , 'parent'];

    public $create_data = [
        'parents' => ['model' => 'Lookup', 'condition' => ['parent_id' => null]],
        'lookup_types' => ['model' => 'LookupType'],
    ];

    public $create = [
        'input' => [
            ['type' => 'text', 'icon' => 'user', 'translate' => true, 'id' => 'name', 'name' => 'name'],
            ['type' => 'text', 'icon' => 'user', 'translate' => false, 'id' => 'key', 'name' => 'key'],
        ],
        'select' => [
            ['type' => 'select', 'icon' => 'user-tag', 'data' => 'parents', 'data_save_item' => 'id', 'data_display_item' => 'name', 'id' => 'parent_id', 'name' => 'parent_id'],
            ['type' => 'select', 'icon' => 'user-tag', 'data' => 'lookup_types', 'data_save_item' => 'id', 'data_display_item' => 'name', 'id' => 'lookup_type_id', 'name' => 'lookup_type_id'],
        ],
    ];

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

    public function permissions()
    {
        return $this->hasMany(RolePermission::class, 'role_id');
    }
}
