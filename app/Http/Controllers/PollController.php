<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePollRequest;
use App\Http\Requests\UpdatePollRequest;
use App\Models\Poll;
use App\Services\PollService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PollController extends Controller
{
    public function __construct(
        private readonly PollService $pollService
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

        return view('polls.show', [
            'poll' => $poll
        ]);
    }

    public function edit(Poll $poll): View
    {
        abort_unless(
            $poll->user_id === auth()->id(),
            403
        );

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

        $this->pollService->update($poll, $request->validated());

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

        $this->pollService->delete($poll);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Votre sondage a bien été supprimé.');
    }
}
