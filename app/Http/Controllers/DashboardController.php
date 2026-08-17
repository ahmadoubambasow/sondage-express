<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $pollsCount = $user->polls()->count();

        $activePollsCount = $user->polls()
            ->where('status', 'active')
            ->count();

        $closedPollsCount = $user->polls()
            ->where('status', 'closed')
            ->count();

        $votesCount = $user->polls()
            ->withCount('votes')
            ->get()
            ->sum('votes_count');

        $recentPolls = $user->polls()
            ->latest()
            ->take(5)
            ->get();


        return view('dashboard', [
            'pollsCount' => $pollsCount,
            'activePollsCount' => $activePollsCount,
            'closedPollsCount' => $closedPollsCount,
            'votesCount' => $votesCount,
            'recentPolls' => $recentPolls
        ]);
    }
}