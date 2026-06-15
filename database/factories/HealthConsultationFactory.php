<?php

namespace Database\Factories;

use App\Models\HealthConsultation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HealthConsultation>
 */
class HealthConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'gender' => fake()->randomElement(['nam', 'nu', 'khac']),
            'age' => fake()->numberBetween(1, 100),
            'phone' => '0' . fake()->numberBetween(300000000, 999999999),
            'reason' => fake()->paragraph(2),
            'medical_history' => fake()->optional(0.7)->sentence(),
            'status' => fake()->randomElement(['pending', 'contacted', 'completed']),
            'admin_notes' => fake()->optional(0.5)->sentence(),
        ];
    }
}



