<?php

namespace Database\Factories;

use App\Models\Lookup;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'birth_date' => '1994-03-14',
            'phone' => $this->faker->phoneNumber(), // password
            'interests' => ['en' => $this->faker->title(), 'ar' => $this->faker->title()],
            'gender_id' => Lookup::whereIn('key', ['male', 'feamle'])->first()->id,
            'country_id' => Lookup::whereIn('key', ['egypt'])->first()->id,
            'city_id' => Lookup::whereIn('key', ['cairo'])->first()->id,
        ];
    }
}
