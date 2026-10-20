<?php

namespace Database\Factories;

use App\Enums\ApplicationStatus;
use App\Models\Application;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'company_name' => fake()->company(),
            'job_role' => fake()->randomElement(['Laravel Developer', 'PHP Developer', 'QA Engineer', 'Full Stack Developer', 'Backend Developer']),
            'location' => fake()->randomElement(['Trivandrum', 'Kochi', 'Bengaluru', 'Remote']),
            'salary' => fake()->randomElement(['₹4–6 LPA', '₹6–8 LPA', '₹8–10 LPA', 'Not disclosed']),
            'job_source' => fake()->randomElement(['LinkedIn', 'Naukri', 'Indeed', 'Referral']),
            'job_url' => fake()->url(),
            'applied_on' => fake()->dateTimeBetween('-6 weeks', 'now'),
            'status' => ApplicationStatus::Applied,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
