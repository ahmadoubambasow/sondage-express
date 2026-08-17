<?php

namespace App\Services;

use App\Models\Poll;

class PollResultService
{
    public function getResults(Poll $poll): array
    {
        $poll->load([
            'options' => function ($query) {
                $query->withCount('votes');
            },
        ]);

        $totalVotes = $poll->votes()->count();

        $options = $poll->options->map(function ($option) use ($totalVotes) {

            $votes = $option->votes_count;

            $percentage = $totalVotes > 0
                ? round(($votes / $totalVotes) * 100, 1)
                : 0;

            return [
                'id' => $option->id,
                'label' => $option->label,
                'votes' => $votes,
                'percentage' => $percentage,
            ];
        });

        $maxVotes = $options->max('votes') ?? 0;

        $winners = $options
            ->where('votes', $maxVotes)
            ->values();

        return [
            'poll' => $poll,
            'totalVotes' => $totalVotes,
            'options' => $options,
            'maxVotes' => $maxVotes,
            'winners' => $winners
        ];
    }
}