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
        'model'
    ];

    public $selected = [];

    public $appends = ['img'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($value) {
            if (file_exists(public_path($value->name))) {
                unlink(public_path($value->name));
            }
        });
    }

    public function getImgAttribute()
    {
        return $this->name ? '<img src="' . asset($this->name) . '" style="width:50px;height:50px" class="rounded-circle">' : null;
    }
}
