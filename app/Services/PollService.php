<?php

namespace App\Services;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PollService
{
    public function create(User $user, array $data): Poll
    {
        return DB::transaction(function () use ($user, $data) {

            $poll = $user->polls()->create([
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'slug' => $this->generateUniqueSlug($data['title']),
                'status' => $data['status'],
                'expires_at' => $data['expires_at'] ?? null,
            ]);

            foreach ($data['options'] as $option) {
                $poll->options()->create([
                    'label' => $option,
                ]);
            }

            return $poll;
        });
    }

    public function update(Poll $poll, array $data): Poll
    {
        return DB::transaction(function () use ($poll, $data) {

            $poll->update([
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'status' => $data['status'],
                'expires_at' => $data['expires_at'] ?? null,
            ]);

            $poll->options()->delete();

            foreach ($data['options'] as $option) {
                $poll->options()->create([
                    'label' => $option,
                ]);
            }

            return $poll->fresh('options');
        });
    }

    public function delete(Poll $poll): void
    {
        DB::transaction(function () use ($poll) {
            $poll->options()->delete();
            $poll->delete();
        });
    }

    private function generateUniqueSlug(string $title): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (Poll::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}