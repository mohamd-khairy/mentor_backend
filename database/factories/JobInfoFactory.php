<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'job_title' => ['en' => $this->faker->title(), 'ar' => $this->faker->title()],
            'bio' => ['en' => $this->faker->text(), 'ar' => $this->faker->text()],
            'topics' => ['en' => $this->faker->title(), 'ar' => $this->faker->title()],
            'company' => ['en' => $this->faker->title(), 'ar' => $this->faker->title()],
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'github' => 'https://github.com',
            'linkedin' => 'https://linkedin.com',
            'youtube' => 'https://youtube.com',
            'instagram' => 'https://instagram.com',
            'website' => 'https://website.com',
            'other' => 'https://other.com',
        ];
    }
}
