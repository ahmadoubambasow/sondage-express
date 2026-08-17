<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sondage
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Messages --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Erreurs de validation --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    {{-- Titre --}}
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ $poll->title }}
                    </h1>

                    {{-- Description --}}
                    @if ($poll->description)
                        <p class="mt-3 text-gray-600">
                            {{ $poll->description }}
                        </p>
                    @endif

                    {{-- Informations du sondage --}}
                    <div class="mt-4 flex flex-wrap gap-4 text-sm text-gray-500">

                        <span>
                            Statut :
                            <strong class="text-gray-700">
                                {{ ucfirst($poll->status) }}
                            </strong>
                        </span>

                        @if ($poll->expires_at)
                            <span>
                                Expire le :
                                <strong class="text-gray-700">
                                    {{ $poll->expires_at->format('d/m/Y H:i') }}
                                </strong>
                            </span>
                        @endif

                        <span>
                            Votes :
                            <strong class="text-gray-700">
                                {{ $poll->votes()->count() }}
                            </strong>
                        </span>

                    </div>

                    {{-- Section vote --}}
                    <div class="mt-8">

                        @if (
                            $poll->status === 'active'
                            && !($poll->expires_at && $poll->expires_at->isPast())
                            && !$hasVoted
                        )

                            {{-- Formulaire de vote --}}
                            <h2 class="font-semibold text-gray-900 mb-4">
                                Choisissez une option
                            </h2>

                            <form
                                method="POST"
                                action="{{ route('polls.vote', $poll) }}"
                            >

                                @csrf

                                <div class="space-y-3">

                                    @foreach ($poll->options as $option)

                                        <label
                                            class="flex items-center gap-3 border rounded-lg p-4 cursor-pointer hover:bg-gray-50"
                                        >

                                            <input
                                                type="radio"
                                                name="poll_option_id"
                                                value="{{ $option->id }}"
                                                required
                                                class="text-indigo-600 focus:ring-indigo-500"
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
                                        class="px-5 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                                    >
                                        Voter
                                    </button>

                                    <a
                                        href="{{ route('polls.results', $poll) }}"
                                        class="px-5 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                                    >
                                        Voir les résultats
                                    </a>

                                </div>

                            </form>

                        @elseif ($hasVoted)

                            {{-- Utilisateur ayant déjà voté --}}
                            <div class="p-4 bg-green-100 text-green-800 rounded-lg">
                                Vous avez déjà voté pour ce sondage.
                            </div>

                            <a
                                href="{{ route('polls.results', $poll) }}"
                                class="mt-4 inline-block px-5 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                            >
                                Voir les résultats
                            </a>

                        @else

                            {{-- Sondage fermé ou expiré --}}
                            <div class="p-4 bg-gray-100 text-gray-600 rounded-lg">

                                @if ($poll->status === 'closed')

                                    Ce sondage est fermé et n'accepte plus de votes.

                                @elseif ($poll->expires_at && $poll->expires_at->isPast())

                                    Ce sondage a expiré et n'accepte plus de votes.

                                @else

                                    Ce sondage n'accepte actuellement plus de votes.

                                @endif

                            </div>

                            <a
                                href="{{ route('polls.results', $poll) }}"
                                class="mt-4 inline-block px-5 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                            >
                                Voir les résultats
                            </a>

                        @endif

                    </div>

                    
                    {{-- Actions du propriétaire --}}
                    @if (
                        $poll->user_id === auth()->id()
                        && $poll->status === 'active'
                        && !($poll->expires_at && $poll->expires_at->isPast())
                    )

                        <div class="mt-8 pt-6 border-t flex flex-wrap gap-3">

                            {{-- Modifier uniquement si aucun vote --}}
                            
                            @if (!$poll->votes()->exists())
                                <a
                                    href="{{ route('polls.edit', $poll) }}"
                                    class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                                >
                                    Modifier
                                </a>
                            @endif

                            {{-- Fermer le sondage --}}
                            <form
                                method="POST"
                                action="{{ route('polls.close', $poll) }}"
                                onsubmit="return confirm('Voulez-vous vraiment fermer ce sondage ?')"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700"
                                >
                                    Fermer le sondage
                                </button>
                            </form>

                            {{-- Supprimer uniquement si aucun vote --}}
                            
                            @if (!$poll->votes()->exists())
                                <form
                                        method="POST"
                                        action="{{ route('polls.destroy', $poll) }}"
                                        onsubmit="return confirm('Voulez-vous vraiment supprimer ce sondage ?')"
                                    >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                                    >
                                        Supprimer
                                    </button>

                                </form>
                            @endif
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>