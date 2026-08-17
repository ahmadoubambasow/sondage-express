<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le sondage
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h1 class="text-2xl font-bold text-gray-900 mb-6">
                        Modifier le sondage
                    </h1>

                    <form
                        method="POST"
                        action="{{ route('polls.update', $poll) }}"
                    >

                        @csrf
                        @method('PUT')

                        {{-- Titre --}}
                        <div class="mb-6">

                            <label
                                for="title"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Titre
                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $poll->title) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            >

                            @error('title')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Description --}}
                        <div class="mb-6">

                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            >{{ old('description', $poll->description) }}</textarea>

                            @error('description')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Options --}}
                        <div class="mb-6">

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Options
                            </label>

                            <div id="options-container" class="space-y-3">

                                @foreach ($poll->options as $option)

                                    <div class="flex gap-2 option-row">

                                        <input
                                            type="text"
                                            name="options[]"
                                            value="{{ old('options.' . $loop->index, $option->label) }}"
                                            required
                                            class="block w-full rounded-md border-gray-300 shadow-sm"
                                        >

                                        @if ($loop->index >= 2)

                                            <button
                                                type="button"
                                                class="remove-option px-3 text-red-600"
                                            >
                                                ✕
                                            </button>

                                        @endif

                                    </div>

                                @endforeach

                            </div>

                            <button
                                type="button"
                                id="add-option"
                                class="mt-3 text-sm text-indigo-600"
                            >
                                + Ajouter une option
                            </button>

                            @error('options')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            @error('options.*')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Statut --}}
                        <div class="mb-6">

                            <label
                                for="status"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Statut
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            >

                                @foreach (['draft' => 'Brouillon', 'active' => 'Actif', 'closed' => 'Fermé'] as $value => $label)

                                    <option
                                        value="{{ $value }}"
                                        @selected(old('status', $poll->status) === $value)
                                    >
                                        {{ $label }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- Expiration --}}
                        <div class="mb-6">

                            <label
                                for="expires_at"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Date d'expiration
                            </label>

                            <input
                                type="datetime-local"
                                id="expires_at"
                                name="expires_at"
                                value="{{ old(
                                    'expires_at',
                                    $poll->expires_at?->format('Y-m-d\TH:i')
                                ) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            >

                        </div>

                        <div class="flex justify-end gap-3">

                            <a
                                href="{{ route('polls.show', $poll) }}"
                                class="px-4 py-2 bg-gray-100 rounded-md"
                            >
                                Annuler
                            </a>

                            <button
                                type="submit"
                                class="px-4 py-2 bg-gray-800 text-white rounded-md"
                            >
                                Enregistrer
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const container = document.getElementById('options-container');
            const addButton = document.getElementById('add-option');

            addButton.addEventListener('click', function () {

                const number =
                    container.querySelectorAll('.option-row').length + 1;

                const row = document.createElement('div');

                row.className = 'flex gap-2 option-row';

                row.innerHTML = `
                    <input
                        type="text"
                        name="options[]"
                        required
                        class="block w-full rounded-md border-gray-300 shadow-sm"
                        placeholder="Option ${number}"
                    >

                    <button
                        type="button"
                        class="remove-option px-3 text-red-600"
                    >
                        ✕
                    </button>
                `;

                container.appendChild(row);
            });

            container.addEventListener('click', function (event) {

                if (event.target.classList.contains('remove-option')) {
                    event.target.closest('.option-row').remove();
                }

            });

        });
    </script>

</x-app-layout>