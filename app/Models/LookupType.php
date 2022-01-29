<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class LookupType extends Model
{
    use HasFactory;
    use HasTranslations;
    use GeneralModel;

    CONST Role = 1;
    CONST Gender = 2;
    CONST Country = 3;
    CONST City = 4;
    CONST Permission = 7;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'key',
    ];

    public $selected = [
        'id',
        'name',
        'key',
    ];

    public $translatable = ['name'];

    public $create = [
        'input' => [
            ['type' => 'text', 'icon' => 'user', 'translate' => true, 'id' => 'name', 'name' => 'name'],
            ['type' => 'text', 'icon' => 'user', 'translate' => false, 'id' => 'key', 'name' => 'key'],
        ],
    ];
}
