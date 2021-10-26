<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

class HospitalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hospital::class;

    /**ss
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'namehospital' => $this->faker->name,
            'codi' => $this->faker->unique()->numberBetween(1, 9999),
            'tipo' => $this->faker->numberBetween(0, 1)
            
        ];
    }
}
