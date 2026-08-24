<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sondage
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-8 sm:py-12">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- =========================================================
                 MESSAGES
            ========================================================== --}}

            @if (session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-xl
                            border border-green-200 bg-green-50 p-4
                            text-green-800">

                    <span class="flex h-8 w-8 items-center justify-center
                                 rounded-full bg-green-100 text-green-600
                                 font-semibold">
                        ✓
                    </span>

                    <span class="text-sm font-medium">
                        {{ session('success') }}
                    </span>

                </div>
            @endif


            @if (session('error'))
                <div class="mb-6 flex items-center gap-3 rounded-xl
                            border border-red-200 bg-red-50 p-4
                            text-red-800">

                    <span class="flex h-8 w-8 items-center justify-center
                                 rounded-full bg-red-100 text-red-600
                                 font-semibold">
                        !
                    </span>

                    <span class="text-sm font-medium">
                        {{ session('error') }}
                    </span>

                </div>
            @endif


            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200
                            bg-red-50 p-4 text-red-800">

                    <ul class="list-disc list-inside space-y-1 text-sm">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif


            {{-- =========================================================
                 CARTE DU SONDAGE
            ========================================================== --}}

            <div class="overflow-hidden rounded-2xl border border-gray-200
                        bg-white shadow-sm">

                <div class="p-6 sm:p-8">


                    {{-- =================================================
                         RETOUR
                    ================================================== --}}

                    <div class="mb-6">

                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center gap-2 text-sm
                                   font-medium text-gray-500 transition
                                   hover:text-gray-900"
                        >

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>

                            Retour au dashboard

                        </a>

                    </div>


                    {{-- =================================================
                         EN-TÊTE DU SONDAGE
                    ================================================== --}}

                    <div>

                        <div class="flex flex-wrap items-start
                                    justify-between gap-4">

                            <div class="min-w-0">

                                <h1 class="text-2xl sm:text-3xl font-bold
                                           tracking-tight text-gray-900">
                                    {{ $poll->title }}
                                </h1>

                                @if ($poll->description)

                                    <p class="mt-3 leading-6 text-gray-600">
                                        {{ $poll->description }}
                                    </p>

                                @endif

                            </div>


                            {{-- Statut --}}
                            <span
                                class="inline-flex shrink-0 items-center
                                       rounded-full px-3 py-1.5 text-xs
                                       font-medium

                                       @if ($poll->status === 'active')
                                           bg-green-50 text-green-700
                                       @elseif ($poll->status === 'closed')
                                           bg-red-50 text-red-700
                                       @else
                                           bg-gray-100 text-gray-600
                                       @endif"
                            >

                                @if ($poll->status === 'active')

                                    <span
                                        class="mr-1.5 h-2 w-2 rounded-full
                                               bg-green-500"
                                    ></span>

                                @elseif ($poll->status === 'closed')

                                    <span
                                        class="mr-1.5 h-2 w-2 rounded-full
                                               bg-red-500"
                                    ></span>

                                @endif

                                {{ ucfirst($poll->status) }}

                            </span>

                        </div>


                        {{-- =================================================
                             INFORMATIONS
                        ================================================== --}}

                        <div class="mt-5 flex flex-wrap gap-x-5 gap-y-2
                                    text-sm text-gray-500">

                            <span class="inline-flex items-center gap-1.5">

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                    />
                                </svg>

                                {{ $poll->votes()->count() }} vote{{ $poll->votes()->count() > 1 ? 's' : '' }}

                            </span>


                            @if ($poll->expires_at)

                                <span class="inline-flex items-center gap-1.5">

                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>

                                    Expire le
                                    {{ $poll->expires_at->format('d/m/Y H:i') }}

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                         PARTAGE
                    ================================================== --}}

                    <div class="mt-7 rounded-xl border border-gray-200
                                bg-gray-50 p-4 sm:p-5">

                        <div class="flex items-start gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center
                                        justify-center rounded-lg bg-white
                                        border border-gray-200 text-gray-600">

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13.828 10.172a4 4 0 010 5.656l-3 3a4 4 0 01-5.656-5.656l1.5-1.5m6.328-1.5l1.5-1.5a4 4 0 015.656 5.656l-3 3a4 4 0 01-5.656 0"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h2 class="font-semibold text-gray-900">
                                    Partager ce sondage
                                </h2>

                                <p class="mt-1 text-sm text-gray-500">
                                    Partagez ce lien pour permettre aux autres
                                    de participer.
                                </p>

                            </div>

                        </div>


                        <div class="mt-4 flex flex-col gap-2 sm:flex-row">

                            <input
                                id="poll-share-url"
                                type="text"
                                readonly
                                value="{{ route('polls.show', $poll) }}"
                                class="min-w-0 flex-1 rounded-lg border-gray-200
                                       bg-white text-sm text-gray-700
                                       focus:border-gray-400
                                       focus:ring-gray-400"
                            >


                            <button
                                type="button"
                                onclick="copyPollLink()"
                                class="inline-flex items-center justify-center
                                       rounded-lg bg-gray-900 px-4 py-2.5
                                       text-sm font-medium text-white
                                       transition hover:bg-gray-800"
                            >
                                Copier
                            </button>


                            <button
                                type="button"
                                onclick="sharePoll()"
                                class="inline-flex items-center justify-center
                                       rounded-lg bg-indigo-600 px-4 py-2.5
                                       text-sm font-medium text-white
                                       transition hover:bg-indigo-700"
                            >
                                Partager
                            </button>

                        </div>


                        <p
                            id="copy-success"
                            class="hidden mt-2 text-sm font-medium
                                   text-green-600"
                        >
                            ✓ Lien copié !
                        </p>

                    </div>


                    {{-- =================================================
                         VOTE
                    ================================================== --}}

                    <div class="mt-8">

                        @if ($isOpen && !$hasVoted)

                            <div class="mb-4">

                                <h2 class="font-semibold text-gray-900">
                                    Choisissez une option
                                </h2>

                                <p class="mt-1 text-sm text-gray-500">
                                    Sélectionnez votre réponse puis validez
                                    votre vote.
                                </p>

                            </div>


                            <form
                                method="POST"
                                action="{{ route('polls.vote', $poll) }}"
                            >

                                @csrf

                                <div class="space-y-3">

                                    @foreach ($poll->options as $option)

                                        <label
                                            class="flex cursor-pointer items-center
                                                   gap-3 rounded-xl border
                                                   border-gray-200 p-4
                                                   transition hover:border-gray-300
                                                   hover:bg-gray-50"
                                        >

                                            <input
                                                type="radio"
                                                name="poll_option_id"
                                                value="{{ $option->id }}"
                                                required
                                                class="h-4 w-4 border-gray-300
                                                       text-indigo-600
                                                       focus:ring-indigo-500"
                                            >

                                            <span class="text-gray-800">
                                                {{ $option->label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>


                                @error('poll_option_id')

                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror


                                <div class="mt-6 flex flex-wrap gap-3">

                                    <button
                                        type="submit"
                                        class="inline-flex items-center
                                               justify-center rounded-lg
                                               bg-gray-900 px-5 py-2.5
                                               text-sm font-semibold text-white
                                               transition hover:bg-gray-800"
                                    >
                                        Voter
                                    </button>


                                    <a
                                        href="{{ route('polls.results', $poll) }}"
                                        class="inline-flex items-center
                                               justify-center rounded-lg
                                               border border-gray-200
                                               bg-white px-5 py-2.5
                                               text-sm font-medium text-gray-700
                                               transition hover:bg-gray-50"
                                    >
                                        Voir les résultats
                                    </a>

                                </div>

                            </form>


                        @elseif ($hasVoted)

                            <div class="rounded-xl border border-green-200
                                        bg-green-50 p-4 text-green-800">

                                <div class="flex items-center gap-3">

                                    <span
                                        class="flex h-8 w-8 items-center
                                               justify-center rounded-full
                                               bg-green-100 text-green-600"
                                    >
                                        ✓
                                    </span>

                                    <p class="text-sm font-medium">
                                        Vous avez déjà voté pour ce sondage.
                                    </p>

                                </div>

                            </div>


                            <a
                                href="{{ route('polls.results', $poll) }}"
                                class="mt-4 inline-flex items-center
                                       justify-center rounded-lg
                                       bg-gray-900 px-5 py-2.5 text-sm
                                       font-semibold text-white
                                       transition hover:bg-gray-800"
                            >
                                Voir les résultats
                            </a>


                        @else

                            <div class="rounded-xl border border-gray-200
                                        bg-gray-50 p-4 text-gray-600">

                                @if ($poll->status === 'closed')

                                    Ce sondage est fermé et n'accepte plus
                                    de votes.

                                @elseif ($poll->expires_at &&
                                        $poll->expires_at->isPast())

                                    Ce sondage a expiré et n'accepte plus
                                    de votes.

                                @else

                                    Ce sondage n'accepte actuellement plus
                                    de votes.

                                @endif

                            </div>


                            <a
                                href="{{ route('polls.results', $poll) }}"
                                class="mt-4 inline-flex items-center
                                       justify-center rounded-lg
                                       bg-gray-900 px-5 py-2.5 text-sm
                                       font-semibold text-white
                                       transition hover:bg-gray-800"
                            >
                                Voir les résultats
                            </a>

                        @endif

                    </div>


                    {{-- =================================================
                        ACTIONS PROPRIÉTAIRE
                    ================================================== --}}

                    @if ($isOwner && $isOpen)

                        <div class="mt-8 border-t border-gray-100 pt-6">

                            <h3 class="mb-4 text-sm font-semibold text-gray-900">
                                Actions du propriétaire
                            </h3>

                            <div class="flex flex-wrap items-center gap-3">

                                {{-- Modifier --}}
                                @if (!$hasVotes)

                                    <a
                                        href="{{ route('polls.edit', $poll) }}"
                                        style="
                                            display: inline-flex;
                                            align-items: center;
                                            justify-content: center;
                                            padding: 10px 16px;
                                            background-color: #d97706;
                                            color: #ffffff;
                                            border-radius: 8px;
                                            font-size: 14px;
                                            font-weight: 600;
                                            text-decoration: none;
                                            cursor: pointer;
                                        "
                                        onmouseover="this.style.backgroundColor='#b45309'"
                                        onmouseout="this.style.backgroundColor='#d97706'"
                                    >
                                        Modifier
                                    </a>

                                @endif


                                {{-- Fermer --}}
                                <form
                                    method="POST"
                                    action="{{ route('polls.close', $poll) }}"
                                    style="display: inline-block; margin: 0;"
                                    onsubmit="return confirm('Voulez-vous vraiment fermer ce sondage ?')"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        style="
                                            display: inline-flex;
                                            align-items: center;
                                            justify-content: center;
                                            padding: 10px 16px;
                                            background-color: #ea580c;
                                            color: #ffffff;
                                            border: none;
                                            border-radius: 8px;
                                            font-size: 14px;
                                            font-weight: 600;
                                            cursor: pointer;
                                        "
                                        onmouseover="this.style.backgroundColor='#c2410c'"
                                        onmouseout="this.style.backgroundColor='#ea580c'"
                                    >
                                        Fermer le sondage
                                    </button>

                                </form>


                                {{-- Supprimer --}}
                                @if (!$hasVotes)

                                    <form
                                        method="POST"
                                        action="{{ route('polls.destroy', $poll) }}"
                                        style="display: inline-block; margin: 0;"
                                        onsubmit="return confirm('Voulez-vous vraiment supprimer ce sondage ?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            style="
                                                display: inline-flex;
                                                align-items: center;
                                                justify-content: center;
                                                padding: 10px 16px;
                                                background-color: #dc2626;
                                                color: #ffffff;
                                                border: none;
                                                border-radius: 8px;
                                                font-size: 14px;
                                                font-weight: 600;
                                                cursor: pointer;
                                            "
                                            onmouseover="this.style.backgroundColor='#b91c1c'"
                                            onmouseout="this.style.backgroundColor='#dc2626'"
                                        >
                                            Supprimer
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>


<script>
    function getPollUrl() {
        return document.getElementById('poll-share-url').value;
    }


    async function copyPollLink() {

        const url = getPollUrl();
        const message = document.getElementById('copy-success');

        try {

            await navigator.clipboard.writeText(url);

        } catch (error) {

            const input = document.getElementById('poll-share-url');

            input.select();
            input.setSelectionRange(0, 99999);

            document.execCommand('copy');
        }

        message.classList.remove('hidden');

        setTimeout(() => {
            message.classList.add('hidden');
        }, 2000);
    }


    async function sharePoll() {

        const url = getPollUrl();
        const title = @json($poll->title);

        if (navigator.share) {

            try {

                await navigator.share({
                    title: title,
                    text: 'Participez à ce sondage : ' + title,
                    url: url
                });

            } catch (error) {

                if (error.name !== 'AbortError') {
                    console.error(error);
                }

            }

        } else {

            await copyPollLink();

        }
    }
</script>