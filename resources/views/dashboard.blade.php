<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    Dashboard
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Gérez vos sondages en toute simplicité.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- =========================================================
                 MESSAGE DE SUCCÈS
            ========================================================== --}}
            @if (session('success'))

                <div class="mb-8 flex items-start gap-3 rounded-xl border
                            border-green-200 bg-green-50 px-4 py-4
                            text-green-800 shadow-sm">

                    <div class="flex h-8 w-8 shrink-0 items-center
                                justify-center rounded-full bg-green-100
                                text-green-600 font-semibold">
                        ✓
                    </div>

                    <div>
                        <p class="font-medium">
                            Opération réussie
                        </p>

                        <p class="mt-0.5 text-sm text-green-700">
                            {{ session('success') }}
                        </p>
                    </div>

                </div>

            @endif


            {{-- =========================================================
                 HEADER
            ========================================================== --}}
            <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-center
                        sm:justify-between">

                <div>

                    <div class="flex items-center gap-2">

                        <h1 class="text-2xl sm:text-3xl font-bold
                                   tracking-tight text-gray-900">
                            Bonjour {{ Auth::user()->name }}
                        </h1>

                        <span class="text-2xl">
                            👋
                        </span>

                    </div>

                    <p class="mt-2 text-gray-500">
                        Voici un aperçu de votre activité.
                    </p>

                </div>


                {{-- Bouton principal --}}
                <a
                    href="{{ route('polls.create') }}"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl bg-gray-900 px-5 py-3 text-sm
                           font-semibold text-white shadow-sm transition
                           hover:bg-gray-800 hover:shadow-md
                           focus:outline-none focus:ring-2
                           focus:ring-gray-900 focus:ring-offset-2"
                >

                    <span class="text-lg leading-none">
                        +
                    </span>

                    Créer un sondage

                </a>

            </div>


            {{-- =========================================================
                 STATISTIQUES
            ========================================================== --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">


                {{-- Mes sondages --}}
                <div class="group rounded-2xl border border-gray-200
                            bg-white p-5 shadow-sm transition
                            hover:-translate-y-0.5 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Mes sondages
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight
                                      text-gray-900">
                                {{ $pollsCount }}
                            </p>

                        </div>


                        <div class="flex h-11 w-11 items-center
                                    justify-center rounded-xl
                                    bg-indigo-50 text-indigo-600">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5h6"
                                />
                            </svg>

                        </div>

                    </div>

                    <p class="mt-4 text-xs text-gray-400">
                        Total de vos sondages
                    </p>

                </div>


                {{-- Total votes --}}
                <div class="group rounded-2xl border border-gray-200
                            bg-white p-5 shadow-sm transition
                            hover:-translate-y-0.5 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Total des votes
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight
                                      text-gray-900">
                                {{ $votesCount }}
                            </p>

                        </div>


                        <div class="flex h-11 w-11 items-center
                                    justify-center rounded-xl
                                    bg-blue-50 text-blue-600">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.333 6.667A2 2 0 0115.431 21H6a2 2 0 01-2-2v-7a2 2 0 012-2h3m5-1V5a3 3 0 00-3-3l-1 5v2h6z"
                                />
                            </svg>

                        </div>

                    </div>

                    <p class="mt-4 text-xs text-gray-400">
                        Votes reçus sur vos sondages
                    </p>

                </div>


                {{-- Sondages actifs --}}
                <div class="group rounded-2xl border border-gray-200
                            bg-white p-5 shadow-sm transition
                            hover:-translate-y-0.5 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Sondages actifs
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight
                                      text-gray-900">
                                {{ $activePollsCount }}
                            </p>

                        </div>


                        <div class="flex h-11 w-11 items-center
                                    justify-center rounded-xl
                                    bg-green-50">

                            <span class="relative flex h-3 w-3">

                                <span
                                    class="absolute inline-flex h-full w-full
                                           animate-ping rounded-full
                                           bg-green-400 opacity-75"
                                ></span>

                                <span
                                    class="relative inline-flex h-3 w-3
                                           rounded-full bg-green-500"
                                ></span>

                            </span>

                        </div>

                    </div>

                    <p class="mt-4 text-xs text-gray-400">
                        Sondages actuellement ouverts
                    </p>

                </div>


                {{-- Sondages terminés --}}
                <div class="group rounded-2xl border border-gray-200
                            bg-white p-5 shadow-sm transition
                            hover:-translate-y-0.5 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Sondages terminés
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight
                                      text-gray-900">
                                {{ $closedPollsCount }}
                            </p>

                        </div>


                        <div class="flex h-11 w-11 items-center
                                    justify-center rounded-xl
                                    bg-gray-100 text-gray-600">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>

                    </div>

                    <p class="mt-4 text-xs text-gray-400">
                        Sondages clôturés
                    </p>

                </div>

            </div>


            {{-- =========================================================
                 MES SONDAGES
            ========================================================== --}}
            <div class="mt-8 overflow-hidden rounded-2xl border
                        border-gray-200 bg-white shadow-sm">


                {{-- -----------------------------------------------------
                     HEADER + RECHERCHE
                ------------------------------------------------------ --}}
                <div class="border-b border-gray-100 px-6 py-5">

                    <div class="flex flex-col gap-4 lg:flex-row
                                lg:items-center lg:justify-between">


                        {{-- Titre --}}
                        <div>

                            <h2 class="text-lg font-semibold text-gray-900">
                                Mes sondages
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Consultez et gérez vos sondages.
                            </p>

                        </div>


                        {{-- Recherche + bouton --}}
                        <div class="flex flex-col gap-3 sm:flex-row">


                            {{-- Recherche --}}
                            <form
                                method="GET"
                                action="{{ route('dashboard') }}"
                                class="relative"
                            >

                                <svg
                                    class="pointer-events-none absolute left-3
                                           top-1/2 h-4 w-4
                                           -translate-y-1/2 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0z"
                                    />
                                </svg>


                                <input
                                    type="search"
                                    name="search"
                                    value="{{ $search ?? request('search') }}"
                                    placeholder="Rechercher un sondage..."
                                    class="w-full sm:w-64 rounded-lg
                                           border-gray-200 bg-gray-50
                                           py-2.5 pl-9 pr-3 text-sm
                                           text-gray-900
                                           placeholder-gray-400
                                           focus:border-gray-400
                                           focus:bg-white
                                           focus:ring-gray-400"
                                >

                            </form>


                            {{-- Nouveau sondage --}}
                            <a
                                href="{{ route('polls.create') }}"
                                class="inline-flex items-center
                                       justify-center gap-2 rounded-lg
                                       bg-gray-900 px-4 py-2.5 text-sm
                                       font-semibold text-white transition
                                       hover:bg-gray-800"
                            >

                                <span class="text-lg leading-none">
                                    +
                                </span>

                                Nouveau sondage

                            </a>

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                     CONTENU
                ====================================================== --}}

                @if ($recentPolls->isEmpty())


                    {{-- -------------------------------------------------
                         AUCUN RÉSULTAT DE RECHERCHE
                    -------------------------------------------------- --}}
                    @if (!empty($search))

                        <div class="px-6 py-16 text-center">

                            <div class="mx-auto flex h-16 w-16
                                        items-center justify-center
                                        rounded-2xl bg-gray-100">

                                <svg
                                    class="h-7 w-7 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0z"
                                    />
                                </svg>

                            </div>


                            <h3 class="mt-5 text-base font-semibold
                                       text-gray-900">
                                Aucun sondage trouvé
                            </h3>


                            <p class="mx-auto mt-2 max-w-md text-sm
                                      text-gray-500">

                                Aucun sondage ne correspond à :

                                <span class="font-medium text-gray-700">
                                    « {{ $search }} »
                                </span>

                            </p>


                            <a
                                href="{{ route('dashboard') }}"
                                class="mt-5 inline-flex items-center
                                       rounded-lg border border-gray-200
                                       px-4 py-2 text-sm font-medium
                                       text-gray-700 transition
                                       hover:bg-gray-50"
                            >
                                Effacer la recherche
                            </a>

                        </div>


                    {{-- -------------------------------------------------
                         AUCUN SONDAGE
                    -------------------------------------------------- --}}
                    @else

                        <div class="px-6 py-16 text-center">

                            <div class="mx-auto flex h-16 w-16
                                        items-center justify-center
                                        rounded-2xl bg-gray-100">

                                <svg
                                    class="h-7 w-7 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 12h6M9 16h4"
                                    />
                                </svg>

                            </div>


                            <h3 class="mt-5 text-base font-semibold
                                       text-gray-900">
                                Aucun sondage pour le moment
                            </h3>


                            <p class="mx-auto mt-2 max-w-sm text-sm
                                      text-gray-500">
                                Créez votre premier sondage et commencez
                                à recueillir des réponses.
                            </p>


                            <a
                                href="{{ route('polls.create') }}"
                                class="mt-6 inline-flex items-center gap-2
                                       rounded-xl bg-gray-900 px-5 py-3
                                       text-sm font-semibold text-white
                                       transition hover:bg-gray-800"
                            >
                                Créer mon premier sondage
                                <span>→</span>
                            </a>

                        </div>

                    @endif


                @else


                    {{-- =================================================
                         LISTE DES SONDAGES
                    ================================================== --}}
                    <div class="divide-y divide-gray-100">

                        @foreach ($recentPolls as $poll)

                            <div class="group px-6 py-5 transition
                                        hover:bg-gray-50">

                                <div class="flex flex-col gap-4
                                            lg:flex-row lg:items-center
                                            lg:justify-between">


                                    {{-- -------------------------------------------------
                                         INFORMATIONS
                                    -------------------------------------------------- --}}
                                    <div class="min-w-0">

                                        <div class="flex flex-wrap
                                                    items-center gap-3">


                                            {{-- Titre --}}
                                            <h3 class="truncate font-semibold
                                                       text-gray-900">

                                                {{ $poll->title }}

                                            </h3>


                                            {{-- Statut --}}
                                            <span
                                                class="shrink-0 inline-flex
                                                       items-center rounded-full
                                                       px-2.5 py-1 text-xs
                                                       font-medium

                                                       @if ($poll->status === 'active')
                                                           bg-green-50 text-green-700

                                                       @elseif ($poll->status === 'closed')
                                                           bg-red-50 text-red-700

                                                       @else
                                                           bg-gray-100 text-gray-600
                                                       @endif
                                                "
                                            >

                                                @if ($poll->status === 'active')

                                                    <span
                                                        class="mr-1.5 h-1.5 w-1.5
                                                               rounded-full
                                                               bg-green-500"
                                                    ></span>

                                                @elseif ($poll->status === 'closed')

                                                    <span
                                                        class="mr-1.5 h-1.5 w-1.5
                                                               rounded-full
                                                               bg-red-500"
                                                    ></span>

                                                @endif

                                                {{ ucfirst($poll->status) }}

                                            </span>

                                        </div>


                                        {{-- Métadonnées --}}
                                        <div
                                            class="mt-2 flex flex-wrap
                                                   items-center gap-x-4
                                                   gap-y-1 text-sm
                                                   text-gray-500"
                                        >

                                            <span>
                                                Créé le
                                                {{ $poll->created_at->format('d/m/Y') }}
                                            </span>


                                            <span class="hidden sm:inline
                                                         text-gray-300">
                                                •
                                            </span>


                                            <span>
                                                {{ $poll->votes_count }}
                                                vote{{ $poll->votes_count > 1 ? 's' : '' }}
                                            </span>

                                        </div>

                                    </div>


                                    {{-- -------------------------------------------------
                                         ACTIONS
                                    -------------------------------------------------- --}}
                                    <div class="flex items-center gap-2">


                                        {{-- Voir --}}
                                        <a
                                            href="{{ route('polls.show', $poll) }}"
                                            class="inline-flex items-center
                                                   gap-1.5 rounded-lg
                                                   border border-gray-200
                                                   px-3.5 py-2 text-sm
                                                   font-medium text-gray-700
                                                   transition
                                                   hover:border-gray-300
                                                   hover:bg-white"
                                        >

                                            Voir

                                            <span
                                                class="transition-transform
                                                       group-hover:translate-x-0.5"
                                            >
                                                →
                                            </span>

                                        </a>


                                        {{-- Modifier --}}
                                        <a
                                            href="{{ route('polls.edit', $poll) }}"
                                            class="inline-flex items-center
                                                   justify-center rounded-lg
                                                   border border-gray-200
                                                   px-3 py-2 text-sm
                                                   font-medium text-gray-500
                                                   transition
                                                   hover:bg-white
                                                   hover:text-gray-700"
                                        >
                                            Modifier
                                        </a>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>