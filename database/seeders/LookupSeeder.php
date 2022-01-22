<?php

namespace Database\Seeders;

use App\Models\Lookup;
use App\Models\LookupType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**************************** lookup role************************** */
        $lookup_type_role_id = LookupType::select('id')->where('key', 'role')->first()->id;
        $lookups_role = [
            [
                'name' => [
                    'en' => 'Admin',
                    'ar' => 'الادمن'
                ],
                'key' => 'admin',
                'parent_id' => null,
                'lookup_type_id' => $lookup_type_role_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'User',
                    'ar' => 'مستخدم'
                ],
                'key' => 'user',
                'parent_id' => null,
                'lookup_type_id' => $lookup_type_role_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'Mentor',
                    'ar' => 'مدرب'
                ],
                'key' => 'mentor',
                'parent_id' => null,
                'lookup_type_id' => $lookup_type_role_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($lookups_role as $l) {
            Lookup::create($l);
        }
         /**************************** lookup permissions************************** */
         $lookup_type_permissions_id = LookupType::select('id')->where('key', 'permissions')->first()->id;
         $lookups_subcategory = [
             [
                 'name' => [
                     'en' => 'Create User',
                     'ar' => 'انشاء مستخدم'
                 ],
                 'key' => 'create-user',
                 'parent_id' => null,
                 'lookup_type_id' => $lookup_type_permissions_id,
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                'name' => [
                    'en' => 'edit User',
                    'ar' => 'تعديل مستخدم'
                ],
                'key' => 'edit-user',
                'parent_id' => null,
                'lookup_type_id' => $lookup_type_permissions_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'show User',
                    'ar' => 'مشاهده مستخدم'
                ],
                'key' => 'show-user',
                'parent_id' => null,
                'lookup_type_id' => $lookup_type_permissions_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'delete User',
                    'ar' => 'حذف مستخدم'
                ],
                'key' => 'delete-user',
                'parent_id' => null,
                'lookup_type_id' => $lookup_type_permissions_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'access User',
                    'ar' => 'التحكم مستخدم'
                ],
                'key' => 'access-user',
                'parent_id' => null,
                'lookup_type_id' => $lookup_type_permissions_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
         ];
         foreach ($lookups_subcategory as $l) {
             Lookup::create($l);
         }
        /**************************** lookup gender************************** */
        $lookup_type_gender_id = LookupType::select('id')->where('key', 'gender')->first()->id;
        $lookups_gender = [
            [
                'name' => [
                    'en' => 'Male',
                    'ar' => 'ذكر'
                ],
                'key' => 'male',
                'parent_id' => null,
                'lookup_type_id' => $lookup_type_gender_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'Female',
                    'ar' => 'انثي'
                ],
                'key' => 'female',
                'parent_id' => null,
                'lookup_type_id' => $lookup_type_gender_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        foreach ($lookups_gender as $l) {
            Lookup::create($l);
        }
        /**************************** lookup country************************** */
        $lookup_type_country_id = LookupType::select('id')->where('key', 'country')->first()->id;
        $lookups_country = [
            [
                'name' => [
                    'en' => 'Egypt',
                    'ar' => 'مصر'
                ],
                'key' => 'egypt',
                'parent_id' => null,
                'lookup_type_id' => $lookup_type_country_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        foreach ($lookups_country as $l) {
            Lookup::create($l);
        }
        /**************************** lookup city************************** */
        $lookup_type_city_id = LookupType::select('id')->where('key', 'city')->first()->id;
        $lookup_egypt_id = Lookup::select('id')->where('key', 'egypt')->first()->id;
        $lookups_city = [
            [
                'name' => [
                    'en' => 'Cairo',
                    'ar' => 'القاهره'
                ],
                'key' => 'cairo',
                'parent_id' => $lookup_egypt_id,
                'lookup_type_id' => $lookup_type_city_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        foreach ($lookups_city as $l) {
            Lookup::create($l);
        }
        /**************************** lookup category************************** */
        $lookup_type_category_id = LookupType::select('id')->where('key', 'category')->first()->id;
        $lookups_category = [
            [
                'name' => [
                    'en' => 'Learning',
                    'ar' => 'التعليم'
                ],
                'key' => 'learning',
                'parent_id' => null,
                'lookup_type_id' => $lookup_type_category_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'Sports',
                    'ar' => 'الرياضة'
                ],
                'key' => 'sports',
                'parent_id' => null,
                'lookup_type_id' => $lookup_type_category_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        foreach ($lookups_category as $l) {
            Lookup::create($l);
        }
        /**************************** lookup subcategory************************** */
        $lookup_type_subcategory_id = LookupType::select('id')->where('key', 'subcategory')->first()->id;
        $lookup_learning_id = Lookup::select('id')->where('key', 'learning')->first()->id;
        $lookup_sports_id = Lookup::select('id')->where('key', 'sports')->first()->id;
        $lookups_subcategory = [
            [
                'name' => [
                    'en' => 'Programming',
                    'ar' => 'البرمجة'
                ],
                'key' => 'programming',
                'parent_id' => $lookup_learning_id,
                'lookup_type_id' => $lookup_type_subcategory_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => [
                    'en' => 'Football',
                    'ar' => 'كرة القدم'
                ],
                'key' => 'football',
                'parent_id' => $lookup_sports_id,
                'lookup_type_id' => $lookup_type_subcategory_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        foreach ($lookups_subcategory as $l) {
            Lookup::create($l);
        }

        User::create([
            'user_name' => Str::slug('admin'),
            'mobile' =>  '01021952160',
            'name' => ['en' => 'admin', 'ar' => 'ادمن'],
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => 'password', //'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // 
            'remember_token' => Str::random(10),
            'role_id' => Lookup::whereIn('key', ['admin'])->first()->id
        ]);
    }
}
