<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sondage
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ $poll->title }}
                    </h1>

                    @if ($poll->description)
                        <p class="mt-3 text-gray-600">
                            {{ $poll->description }}
                        </p>
                    @endif

                    <div class="mt-6">

                        <h2 class="font-semibold text-gray-900 mb-4">
                            Options
                        </h2>

                        <div class="space-y-3">

                            @foreach ($poll->options as $option)

                                <div class="border rounded-lg p-4">
                                    {{ $option->label }}
                                </div>

                            @endforeach

                            @if ($poll->user_id === auth()->id())

                                <div class="mt-6 flex gap-3">

                                    <a
                                        href="{{ route('polls.edit', $poll) }}"
                                        class="px-4 py-2 bg-gray-800 text-white rounded-md"
                                    >
                                        Modifier
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('polls.destroy', $poll) }}"
                                        onsubmit="return confirm('Voulez-vous vraiment supprimer ce sondage ?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="px-4 py-2 bg-red-600 text-white rounded-md"
                                        >
                                            Supprimer
                                        </button>

                                    </form>

                                </div>

                            @endif

                        </div>

                    </div>

                    <div class="mt-6">
                        <span class="text-sm text-gray-500">
                            Statut :
                            {{ ucfirst($poll->status) }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>