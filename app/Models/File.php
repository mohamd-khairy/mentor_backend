<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'item_id',
    ];

    public $visible = [
        'id',
        'name',
        'type',
        'item_id',
    ];
    
    public $timestamps = false;

    protected $fillableType = [];
    
    public function getfillableTypes()
    {
        return $this->fillableType;
    }
}
