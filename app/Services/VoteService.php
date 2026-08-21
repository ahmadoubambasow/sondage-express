<?php

namespace App\Services;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class VoteService
{
    /**
     * Enregistre un vote.
     *
     * Le vote peut provenir :
     * - d'un utilisateur connecté ;
     * - d'un visiteur identifié par un voter_token.
     */
    public function vote(
        ?User $user,
        Poll $poll,
        int $pollOptionId,
        string $voterToken
    ): void {
        DB::transaction(function () use (
            $user,
            $poll,
            $pollOptionId,
            $voterToken
        ) {

            $this->ensurePollCanReceiveVote($poll);

            $this->ensureOptionBelongsToPoll(
                $poll,
                $pollOptionId
            );

            $this->ensureVoterHasNotVoted(
                $user,
                $poll,
                $voterToken
            );

            $poll->votes()->create([
                'poll_option_id' => $pollOptionId,

                // Utilisateur connecté : son ID
                // Visiteur : NULL
                'user_id' => $user?->id,

                // Utilisateur connecté : NULL
                // Visiteur : son token
                'voter_token' => $user
                    ? null
                    : $voterToken,
            ]);
        });
    }

    /**
     * Vérifie que le sondage est encore ouvert.
     */
    private function ensurePollCanReceiveVote(
        Poll $poll
    ): void {
        if ($poll->status !== 'active') {
            throw new RuntimeException(
                'Ce sondage n\'accepte pas actuellement de votes.'
            );
        }

        if (
            $poll->expires_at
            && $poll->expires_at->isPast()
        ) {
            throw new RuntimeException(
                'Ce sondage a expiré.'
            );
        }
    }

    /**
     * Vérifie que l'option appartient au sondage.
     */
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

    /**
     * Vérifie que le votant n'a pas déjà voté.
     *
     * Utilisateur connecté :
     * recherche par user_id.
     *
     * Visiteur :
     * recherche par voter_token.
     */
    private function ensureVoterHasNotVoted(
        ?User $user,
        Poll $poll,
        string $voterToken
    ): void {

        if ($user) {

            // Utilisateur connecté
            $alreadyVoted = $poll->votes()
                ->where('user_id', $user->id)
                ->exists();

        } else {

            // Visiteur
            $alreadyVoted = $poll->votes()
                ->where('voter_token', $voterToken)
                ->exists();
        }

        if ($alreadyVoted) {
            throw new RuntimeException(
                'Vous avez déjà participé à ce sondage.'
            );
        }
    }
}