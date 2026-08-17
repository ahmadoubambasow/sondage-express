<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un sondage
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">
                            Créer un sondage
                        </h1>

                        <p class="text-gray-600 mt-1">
                            Créez rapidement votre sondage.
                        </p>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('polls.store') }}"
                    >

                        @csrf

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
                                name="title"
                                id="title"
                                value="{{ old('title') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                       focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Ex : Quel framework préférez-vous ?"
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
                                name="description"
                                id="description"
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                       focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Décrivez votre sondage..."
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Options --}}
                        <div class="mb-6">

                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Options
                                </label>

                                <button
                                    type="button"
                                    id="add-option"
                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-800"
                                >
                                    + Ajouter une option
                                </button>
                            </div>

                            <div id="options-container" class="space-y-3">

                                @php
                                    $oldOptions = old('options', ['', '']);
                                @endphp

                                @foreach ($oldOptions as $index => $option)

                                    <div class="flex gap-2 option-row">

                                        <input
                                            type="text"
                                            name="options[]"
                                            value="{{ $option }}"
                                            required
                                            class="block w-full rounded-md border-gray-300 shadow-sm
                                                focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="Option {{ $index + 1 }}"
                                        >

                                        @if ($index >= 2)

                                            <button
                                                type="button"
                                                class="remove-option px-3 py-2 text-red-600
                                                    hover:text-red-800"
                                            >
                                                ✕
                                            </button>

                                        @endif

                                    </div>

                                @endforeach

                            </div>

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
                                name="status"
                                id="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                       focus:border-indigo-500 focus:ring-indigo-500"
                            >

                                <option
                                    value="draft"
                                    @selected(old('status') === 'draft')
                                >
                                    Brouillon
                                </option>

                                <option
                                    value="active"
                                    @selected(old('status') === 'active')
                                >
                                    Actif
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Date d'expiration --}}
                        <div class="mb-6">

                            <label
                                for="expires_at"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Date d'expiration
                            </label>

                            <input
                                type="datetime-local"
                                name="expires_at"
                                id="expires_at"
                                value="{{ old('expires_at') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                       focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('expires_at')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3">

                            <a
                                href="{{ route('dashboard') }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700
                                       bg-gray-100 rounded-md hover:bg-gray-200"
                            >
                                Annuler
                            </a>

                            <button
                                type="submit"
                                class="px-4 py-2 text-sm font-semibold text-white
                                       bg-gray-800 rounded-md hover:bg-gray-700"
                            >
                                Créer le sondage
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const container = document.getElementById('options-container');
        const addButton = document.getElementById('add-option');

        function updateRemoveButtons() {
            const rows = container.querySelectorAll('.option-row');

            rows.forEach((row, index) => {

                const button = row.querySelector('.remove-option');

                if (index < 2) {
                    if (button) {
                        button.remove();
                    }
                }
            });
        }

        addButton.addEventListener('click', function () {

            const optionNumber =
                container.querySelectorAll('.option-row').length + 1;

            const row = document.createElement('div');

            row.className = 'flex gap-2 option-row';

            row.innerHTML = `
                <input
                    type="text"
                    name="options[]"
                    required
                    class="block w-full rounded-md border-gray-300 shadow-sm
                           focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Option ${optionNumber}"
                >

                <button
                    type="button"
                    class="remove-option px-3 py-2 text-red-600
                           hover:text-red-800"
                >
                    ✕
                </button>
            `;

            container.appendChild(row);
        });

        container.addEventListener('click', function (event) {

            if (!event.target.classList.contains('remove-option')) {
                return;
            }

            event.target.closest('.option-row').remove();
        });
    });
</script>