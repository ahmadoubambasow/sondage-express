<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-200
                    text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">
                    Bonjour {{ Auth::user()->name }} 👋
                </h1>

                <p class="text-gray-600 mt-1">
                    Voici un aperçu de vos sondages.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-500 text-sm">
                        Mes sondages
                    </p>

                    <p class="text-3xl font-bold mt-2">
                        {{ $pollsCount }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-500 text-sm">
                        Total des votes
                    </p>

                    <p class="text-3xl font-bold mt-2">
                        {{ $votesCount }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-500 text-sm">
                        Sondages actifs
                    </p>

                    <p class="text-3xl font-bold mt-2">
                        {{ $activePollsCount }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-500 text-sm">
                        Sondages terminés
                    </p>

                    <p class="text-3xl font-bold mt-2">
                        {{ $closedPollsCount }}
                    </p>
                </div>

            </div>

            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">

            <div class="p-6">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">
                            Mes sondages
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Vos derniers sondages créés.
                        </p>
                    </div>

                    <a
                        href="{{ route('polls.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800
                            border border-transparent rounded-md font-semibold
                            text-xs text-white uppercase tracking-widest
                            hover:bg-gray-700"
                    >
                        + Créer un sondage
                    </a>

                </div>

                @if ($recentPolls->isEmpty())

                    <div class="text-center py-8">
                        <p class="text-gray-500">
                            Vous n'avez encore créé aucun sondage.
                        </p>
                    </div>

                @else

                    <div class="divide-y">

                        @foreach ($recentPolls as $poll)

                            <div class="py-4 flex items-center justify-between">

                                <div>
                                    <h3 class="font-medium text-gray-900">
                                        {{ $poll->title }}
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Créé le
                                        {{ $poll->created_at->format('d/m/Y') }}
                                    </p>

                                    <a 
                                        href="{{ route('polls.show', $poll) }}"
                                        class="text-sm font-medium text-indigo-600 hover:text-indigo-800"
                                    >
                                        Voir
                                    </a>
                                </div>

                                <div class="flex items-center gap-4">

                                    <span class="text-sm text-gray-500">
                                        {{ $poll->votes()->count() }} vote(s)
                                    </span>

                                    <span class="px-2 py-1 text-xs rounded-full
                                        @if ($poll->status === 'active')
                                            bg-green-100 text-green-700
                                        @elseif ($poll->status === 'closed')
                                            bg-red-100 text-red-700
                                        @else
                                            bg-gray-100 text-gray-700
                                        @endif
                                    ">
                                        {{ ucfirst($poll->status) }}
                                    </span>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>

        </div>

    </div>

</x-app-layout>