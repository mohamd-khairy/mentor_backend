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

    public $fillableType = [
        ['item_name' => 'name' , 'item_type' => 'input'],
        ['item_name' => 'key' , 'item_type' => 'input'],
    ];

    public $casts = [
        'name' => 'array',
    ];

    public $translatable = ['name'];
}
