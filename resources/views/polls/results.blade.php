<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Résultats du sondage
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    {{-- Titre --}}
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ $poll->title }}
                    </h1>

                    @if ($poll->description)
                        <p class="mt-3 text-gray-600">
                            {{ $poll->description }}
                        </p>
                    @endif

                    {{-- Total --}}
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">
                            Nombre total de votes
                        </p>

                        <p class="text-3xl font-bold text-gray-900">
                            {{ $totalVotes }}
                        </p>
                    </div>

                    {{-- Résultats --}}
                    <div class="mt-8">

                        <h2 class="font-semibold text-gray-900 mb-6">
                            Résultats
                        </h2>

                        <div class="space-y-6">

                            @foreach ($options as $option)

                                <div>

                                    <div class="flex justify-between mb-2">

                                        <span class="font-medium text-gray-800">
                                            {{ $option['label'] }}
                                        </span>

                                        <span class="text-sm text-gray-500">
                                            {{ $option['votes'] }}
                                            vote(s)
                                            —
                                            {{ $option['percentage'] }}%
                                        </span>

                                    </div>

                                    <div class="w-full bg-gray-200 rounded-full h-4">

                                        <div
                                            class="bg-indigo-600 h-4 rounded-full"
                                            style="width: {{ $option['percentage'] }}%"
                                        ></div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                    {{-- Gagnant --}}
                    @if ($totalVotes > 0)

                        <div class="mt-8 p-4 bg-green-50 rounded-lg">

                            <h2 class="font-semibold text-green-800">
                                Résultat actuel
                            </h2>

                            <p class="mt-2 text-green-700">


                                @if ($winners->count() === 1)

                                    L'option gagnante est
                                    <strong>
                                        {{ $winners->first()['label'] }}
                                    </strong>
                                    avec
                                    <strong>
                                        {{ $maxVotes }}
                                        vote(s)
                                    </strong>.

                                @else

                                    Il y a actuellement une égalité entre :

                                    <strong>
                                        {{ $winners->pluck('label')->join(', ') }}
                                    </strong>.

                                @endif

                            </p>

                        </div>

                    @endif

                    {{-- Retour --}}
                    <div class="mt-8">

                        <a
                            href="{{ route('polls.show', $poll) }}"
                            class="text-indigo-600 hover:text-indigo-800"
                        >
                            ← Retour au sondage
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>