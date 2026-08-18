<?php

namespace App\Http\Controllers;

use App\Exceptions\PollClosureException;
use App\Exceptions\PollModificationException;
use App\Http\Requests\StorePollRequest;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdatePollRequest;
use App\Models\Poll;
use App\Services\PollResultService;
use App\Services\PollService;
use App\Services\VoteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PollController extends Controller
{
    public function __construct(
        private readonly PollService $pollService,
        private readonly VoteService $voteService,
        private readonly PollResultService $pollResultService
    ){}

    public function create(): View
    {
        return view('polls.create');
    }

    public function store(StorePollRequest $request): RedirectResponse
    {
        $this->pollService->create(
            $request->user(),
            $request->validated()
        );

        return redirect()
            ->route('dashboard')
            ->with('success', 'Votre sondage a été créé aec succès.');
    }

    public function show(Poll $poll): View
    {
        $poll->load('options');

        $hasVoted = $poll->votes()
            ->where('user_id', auth()->id())
            ->exists();

        $hasVotes = $poll->votes()->exists();

        $isOwner = $poll->user_id === auth()->id();

        $isOpen = $poll->status === 'active'
            && (!$poll->expires_at || $poll->expires_at->isFuture());

        return view('polls.show', [
            'poll' => $poll,
            'hasVoted' => $hasVoted,
            'hasVotes' => $hasVotes,
            'isOwner' => $isOwner,
            'isOpen' => $isOpen,
        ]);
    }

    public function edit(Poll $poll): View
    {
        abort_unless(
            $poll->user_id === auth()->id(),
            403
        );

        if (!$this->pollService->canBeModified($poll)) {
            return redirect()
                ->route('polls.show', $poll)
                ->with(
                    'error',
                    'Ce sondage ne peut plus être modifié.'
                );
        }


        $poll->load('options');

        return view('polls.edit', [
            'poll' => $poll
        ]);
    }

    public function update(UpdatePollRequest $request, Poll $poll): RedirectResponse
    {
        abort_unless(
            $poll->user_id === $request->user()->id,
            403
        );

        try {

            $this->pollService->update($poll, $request->validated());
        
        } catch (PollModificationException $exception) {
            
            return back()
                ->withInput()
                ->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('polls.show', $poll)
            ->with('success', 'Votre sondage a bien été mis à jour.');
    }

    public function destroy(Poll $poll): RedirectResponse
    {
        abort_unless(
            $poll->user_id === auth()->id(),
            403
        );

        try {

            $this->pollService->delete($poll);

        } catch (PollModificationException $exception) {

            return back()
                ->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('dashboard')
            ->with('success', 'Votre sondage a bien été supprimé.');
    }

    public function vote(StoreVoteRequest $request, Poll $poll): RedirectResponse
    {
        try {

            $this->voteService->vote($request->user(), $poll, (int) $request->validated('poll_option_id'));
        
        } catch (\RuntimeException $exception) {
            return back()
                ->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('polls.show', $poll)
            ->with('success', 'Votre vote a été enregistré.');
    }

    public function results(Poll $poll): View
    {
        $results = $this->pollResultService->getResults($poll);

        return view('polls.results', $results);
    }

    public function close(Poll $poll): RedirectResponse
    {
        abort_unless(
            $poll->user_id === auth()->id(),
            403
        );

        try {
            $this->pollService->close($poll);
        } catch (PollClosureException $exception) {
            return back()
                ->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('polls.show', $poll)
            ->with(
                'success',
                'Le sondage a été fermé avec succès.'
            );
    }
}
