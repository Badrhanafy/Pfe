<?php

namespace Database\Factories;

use App\Models\Artisan;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtisanFactory extends Factory
{
    protected $model = Artisan::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'profession' => $this->faker->randomElement([
                'Electrician', 'Plumber', 'Painter', 'Carpenter', 'Mechanic', 'Mason', 'Gardener'
            ]),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), 
            'address' => $this->faker->address(),
            'bio' => $this->faker->sentence(15), // جملة صغيرة تعرف بيه
            'experience_years' => $this->faker->numberBetween(1, 30), // عدد سنوات الخبرة بين 1 و 30
        ];
    }
}
