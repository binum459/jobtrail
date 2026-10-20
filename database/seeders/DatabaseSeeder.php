<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Models\Application;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::where('email', 'demo@jobtrail.test')->delete();
        $demo = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@jobtrail.test',
            'password' => 'password',
        ]);

        Application::factory()->count(3)->for($demo)->create([
            'status' => ApplicationStatus::Wishlist,
            'applied_on' => null,
        ]);

        Application::factory()->count(5)->for($demo)->create([
            'status' => ApplicationStatus::Applied,
        ]);

        Application::factory()->count(3)->for($demo)->create([
            'status' => ApplicationStatus::Interview,
        ]);

        Application::factory()->count(1)->for($demo)->create([
            'status' => ApplicationStatus::Offer,
        ]);

        Application::factory()->count(2)->for($demo)->create([
            'status' => ApplicationStatus::Rejected,
        ]);

        Application::factory()->count(1)->for($demo)->create([
            'status' => ApplicationStatus::Ghosted,
        ]);

    }
}
