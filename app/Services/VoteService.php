<?php

namespace App\Services;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class VoteService
{
    public function vote(User $user, Poll $poll, int $pollOptionId): void {
        DB::transaction(function () use ($user, $poll, $pollOptionId) {   
        
            $this->ensurePollCanReceiveVote($poll);

            $this->ensureOptionBelongsToPoll($poll, $pollOptionId);

            $this->ensureUserHasNotVoted($user, $poll);

            $poll->votes()->create([
                'poll_option_id' => $pollOptionId,
                'user_id' => $user->id,
                'voter_token' => null,
            ]);
        });
    }

    private function ensurePollCanReceiveVote(Poll $poll): void
    {
        if ($poll->status !== 'active') {
            throw new RuntimeException(
                'Ce sondage n\'accepte pas actuellement de votes.'
            );
        }

        if($poll->expires_at && $poll->expires_at ->isPast()) {
            throw new RuntimeException(
                'Ce sondage a expiré.'
            );
        }
    }

    private function ensureOptionBelongsToPoll(
        Poll $poll,
        int $pollOptionId
    ): void {
        $exists = $poll->options()
            ->whereKey($pollOptionId)
            ->exists();

        if (!$exists) {
            throw new RuntimeException(
                'Cette option n\'appartient pas à ce sondage.'
            );
        }
    }
 
    private function ensureUserHasNotVoted(
        User $user,
        Poll $poll
    ): void {
        $alreadyVoted = $poll->votes()
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyVoted) {
            throw new RuntimeException(
                'Vous avez déjà participé à ce sondage.'
            );
        }
    }
}