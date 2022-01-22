<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class JobInfo extends Model
{
    use HasFactory;
    use HasTranslations;
    use GeneralModel;

    protected $fillable = [
        'user_id',
        'job_title',
        'bio',
        'topics',
        'company',
        'facebook',
        'twitter',
        'github',
        'linkedin',
        'youtube',
        'instagram',
        'website',
        'other',
    ];

    public $selected = [
        'id',
        'user',
        'job_title',
        'topics',
        'company',
        'cv'
    ];

    public $translatable = [
        'job_title',
        'bio',
        'topics',
        'company',
    ];

    public $relations_array = [
        'user_object' => ['item' => 'user_id', 'relation_name' => 'user', 'coulmn' => 'name'],
        'photo_object' => ['item' => null, 'relation_name' => 'cv', 'coulmn' => 'name']
    ];

    public $with = ['user' , 'cv'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cv()
    {
        return $this->hasOne(File::class, 'item_id', 'user_id')->where('type', 'cv');
    }
}
