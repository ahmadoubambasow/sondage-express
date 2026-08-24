<?php

namespace App\Services;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class VoteService
{
    /**
     * Enregistre ou modifie le vote.
     *
     * Le vote peut provenir :
     * - d'un utilisateur connecté ;
     * - d'un visiteur identifié par un voter_token.
     *
     * Un participant peut modifier son vote tant que
     * le sondage est encore ouvert.
     */
    public function vote(
        ?User $user,
        Poll $poll,
        array $pollOptionIds,
        string $voterToken
    ): void {
        DB::transaction(function () use (
            $user,
            $poll,
            $pollOptionIds,
            $voterToken
        ) {

            $this->ensurePollCanReceiveVote($poll);

            $pollOptionIds = array_values(
                array_unique(
                    array_map('intval', $pollOptionIds)
                )
            );

            if (empty($pollOptionIds)) {
                throw new RuntimeException(
                    'Vous devez sélectionner au moins une option.'
                );
            }

            /*
             * Vérifie si le sondage autorise plusieurs choix.
             */
            if (
                !$poll->allow_multiple_choices
                && count($pollOptionIds) > 1
            ) {
                throw new RuntimeException(
                    'Ce sondage n’autorise qu’un seul choix.'
                );
            }

            /*
             * Vérifie que toutes les options appartiennent
             * bien au sondage.
             */
            foreach ($pollOptionIds as $pollOptionId) {
                $this->ensureOptionBelongsToPoll(
                    $poll,
                    $pollOptionId
                );
            }

            /*
             * Supprime les anciens votes du participant.
             *
             * Cela permet de modifier son vote.
             */
            $this->deletePreviousVotes(
                $user,
                $poll,
                $voterToken
            );

            /*
             * Enregistre les nouveaux choix.
             */
            foreach ($pollOptionIds as $pollOptionId) {

                $poll->votes()->create([
                    'poll_option_id' => $pollOptionId,

                    'user_id' => $user?->id,

                    'voter_token' => $user
                        ? null
                        : $voterToken,
                ]);
            }
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
     * Supprime les votes précédents du participant.
     *
     * Utilisateur connecté :
     * recherche par user_id.
     *
     * Visiteur :
     * recherche par voter_token.
     */
    private function deletePreviousVotes(
        ?User $user,
        Poll $poll,
        string $voterToken
    ): void {

        if ($user) {

            $poll->votes()
                ->where('user_id', $user->id)
                ->delete();

        } else {

            $poll->votes()
                ->where('voter_token', $voterToken)
                ->delete();
        }
    }
}