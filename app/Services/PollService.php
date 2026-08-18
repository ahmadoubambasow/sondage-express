<?php

namespace App\Services;

use App\Exceptions\PollClosureException;
use App\Exceptions\PollModificationException;
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
        $this->ensureCanBeModified($poll);

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

    public function canBeModified(Poll $poll): bool
    {
        return $poll->status !== 'closed' 
            && !($poll->expires_at || $poll->expires_at->isFuture())
            && !$poll->votes()->exists();
    }

    public function delete(Poll $poll): void
    {
        $this->ensureCanBeModified($poll);

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

    private function ensureCanBeModified(Poll $poll): void
    {
        if ($poll->status === 'closed') {
            throw new PollModificationException(
                'Ce sondage est fermé et ne peut plus être modifié.'
            );
        }

        if ($poll->expires_at && $poll->expires_at->isPast()) {
            throw new PollModificationException(
                'Ce sondage a expiré et ne peut plus être modifié.'
            );
        }

        if ($poll->votes()->exists()) {
            throw new PollModificationException(
                'Ce sondage a déjà reçu des votes et ne peut plus être modifie.'
            );
        }
    }

    public function close(Poll $poll): Poll
    {
        if ($poll->status === 'closed') {
            throw new PollModificationException(
                'Ce sondage est fermé déjà fermé.'
            );
        }

        if (
            $poll->expires_at &&
            $poll->expires_at->isPast()
        ) {
            throw new PollClosureException(
                'Ce sondage a déjà expiré.'
            );
        }

        $poll->update([
            'status' => 'closed',
        ]);

        return $poll->fresh();
    }
}