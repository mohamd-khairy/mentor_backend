<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    use GeneralModel;

    protected $fillable = [
        'name',
        'type',
        'item_id',
    ];

    public $visible = [
        'id',
        'name',
        'type',
    ];

    public $timestamps = false;
}
