<?php

namespace Database\Factories;

use App\Models\Poll;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends Factory<Poll>
 */
class PollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'description' => fake()->paragraph(),
            'slug' => str()->slug($title) . '-' .fake()->numberBetween(1000, 9999),
            'status' => fake()->randomElement(['draft', 'active', 'closed']),
            'expires_at' => fake()->optional()->dateTimeBetween('now', '+30 days'),
        ];
    }

    public function withOptions(int $count = 4): static
    {
        return $this->hasOptions($count);
    }
}
