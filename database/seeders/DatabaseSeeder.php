<?php

namespace Database\Seeders;

use App\Models\Lookup;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LookupTypeSeeder::class,
            LookupSeeder::class,
        ]);

        \App\Models\User::factory(4)->create()->each(function ($u) {
            if ($u->role_id == 2) {
                \App\Models\ProfileInfo::factory(1)->create(['user_id' => $u->id]);
            } elseif ($u->role_id == 3) {
                \App\Models\JobInfo::factory(1)->create(['user_id' => $u->id]);
            }
        });
    }
}
