<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;
    use GeneralModel;

    public $fillable = ['role_id', 'permission_id', 'key'];
    
    public $selected = ['id', 'role', 'permission', 'key'];

    public $relations_array = [
        'role_object' => ['item' => 'role_id', 'relation_name' => 'role', 'coulmn' => 'name'],
        'permission_object' => ['item' => 'permission_id', 'relation_name' => 'permission', 'coulmn' => 'name'],
    ];

    public $create_data = [
        'roles' => ['model' => 'Lookup', 'condition' => ['lookup_type_id' => LookupType::Role]],
        'permissions' => ['model' => 'Lookup', 'condition' => ['lookup_type_id' => LookupType::Permission]]
    ];

    public $create = [
        'select' => [
            ['type' => 'select', 'multiple' => false, 'icon' => 'user-tag', 'data' => 'roles', 'data_save_item' => 'id', 'data_display_item' => 'name', 'id' => 'role_id', 'name' => 'role_id'],
            ['type' => 'select', 'multiple' => true, 'icon' => 'user-tag', 'data' => 'permissions', 'data_save_item' => 'id', 'data_display_item' => 'name', 'id' => 'permission_id', 'name' => 'permission_id[]'],
        ],
    ];


    public function role()
    {
        return $this->belongsTo(Lookup::class, 'role_id');
    }

    public function permission()
    {
        return $this->belongsTo(Lookup::class, 'permission_id');
    }
}
