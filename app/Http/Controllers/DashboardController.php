<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Statistiques
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | Recherche
        |--------------------------------------------------------------------------
        */

        $search = trim($request->input('search', ''));

        $recentPolls = $user->polls()
            ->withCount('votes')
            ->when($search !== '', function ($query) use ($search) {

                $query->where('title', 'like', '%' . $search . '%');

            })
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Vue
        |--------------------------------------------------------------------------
        */

        return view('dashboard', [
            'pollsCount' => $pollsCount,
            'activePollsCount' => $activePollsCount,
            'closedPollsCount' => $closedPollsCount,
            'votesCount' => $votesCount,
            'recentPolls' => $recentPolls,
            'search' => $search,
        ]);
    }
}