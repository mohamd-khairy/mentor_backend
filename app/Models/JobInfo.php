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
        'photo_object' => ['item' => null, 'relation_name' => 'cv', 'coulmn' => 'img']
    ];

    public $with = ['user', 'cv'];

    public $create_data = [
        'users' => ['model' => 'User']
    ];

    public $create = [
        'select' => [
            ['type' => 'select', 'icon' => 'user-tag', 'data' => 'users', 'data_save_item' => 'id', 'data_display_item' => 'name', 'id' => 'user_id', 'name' => 'user_id'],
        ],
        'textarea' => [
            ['type' => 'text', 'icon' => 'user', 'translate' => true, 'id' => 'bio', 'name' => 'bio'],
        ],
        'input' => [
            ['type' => 'text', 'icon' => 'user', 'translate' => true, 'id' => 'job_title', 'name' => 'job_title'],
            ['type' => 'text', 'icon' => 'user', 'translate' => true, 'id' => 'topics', 'name' => 'topics'],
            ['type' => 'text', 'icon' => 'user', 'translate' => true, 'id' => 'company', 'name' => 'company'],

            ['type' => 'text', 'icon' => 'user', 'translate' => false, 'id' => 'facebook', 'name' => 'facebook'],
            ['type' => 'text', 'icon' => 'envelope', 'translate' => false, 'id' => 'twitter', 'name' => 'twitter'],
            ['type' => 'text', 'icon' => 'key', 'translate' => false, 'id' => 'github', 'name' => 'github'],
            ['type' => 'text', 'icon' => 'user', 'translate' => false, 'id' => 'linkedin', 'name' => 'linkedin'],
            ['type' => 'text', 'icon' => 'user', 'translate' => false, 'id' => 'youtube', 'name' => 'youtube'],
            ['type' => 'text', 'icon' => 'user', 'translate' => false, 'id' => 'instagram', 'name' => 'instagram'],
            ['type' => 'text', 'icon' => 'user', 'translate' => false, 'id' => 'website', 'name' => 'website'],
            ['type' => 'text', 'icon' => 'user', 'translate' => false, 'id' => 'other', 'name' => 'other'],

        ],
        'image' => [
            ['type' => 'cv', 'icon' => 'image', 'id' => 'image', 'name' => 'image'],
        ],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cv()
    {
        return $this->hasOne(File::class, 'item_id')->where('type', 'cv');
    }
}
