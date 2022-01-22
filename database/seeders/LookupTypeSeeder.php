<?php

namespace Database\Seeders;

use App\Models\LookupType;
use Illuminate\Database\Seeder;

class LookupTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lookup_types = [
            [
                'name' => [
                    'en' => 'Role',
                    'ar' => 'الادوار'
                ],
                'key' => 'role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'Gender',
                    'ar' => 'الجنس'
                ],
                'key' => 'gender',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'Countries',
                    'ar' => 'البلدان'
                ],
                'key' => 'country',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'Cities',
                    'ar' => 'المدن'
                ],
                'key' => 'city',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'Categories',
                    'ar' => 'الفئات'
                ],
                'key' => 'category',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'Sub Categories',
                    'ar' => ' الفئات الفرعيه'
                ],
                'key' => 'subcategory',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'Permissions',
                    'ar' => 'الصلاحيات'
                ],
                'key' => 'permissions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($lookup_types as $l) {
            LookupType::create($l);
        }
    }
}
