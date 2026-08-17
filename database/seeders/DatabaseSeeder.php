<?php

namespace Database\Seeders;

use App\Models\Poll;
use App\Models\PollOption;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $users->each(function (User $user) {
            Poll::factory(2)
                ->create([
                    'user_id' => $user->id,
                ])
                ->each(function (Poll $poll) {
                    PollOption::factory(4)
                        ->create([
                            'poll_id' => $poll->id,
                        ]);
                });
        });
    }
}
