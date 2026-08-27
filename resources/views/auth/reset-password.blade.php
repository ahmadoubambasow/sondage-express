<x-guest-layout>

    <div class="w-full">

        {{-- =========================================================
             EN-TÊTE
        ========================================================== --}}

        <div class="mb-8 text-center">

            {{-- Logo --}}
            <div class="mb-5 flex justify-center">

                <div
                    class="flex h-12 w-12 items-center justify-center
                           rounded-xl bg-indigo-600
                           text-xl font-bold !text-white shadow-sm"
                >
                    S
                </div>

            </div>

            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Nouveau mot de passe
            </h1>

            <p class="mt-2 text-sm leading-6 text-gray-500">
                Choisissez un nouveau mot de passe sécurisé pour votre compte
                Sondage Express.
            </p>

        </div>


        {{-- =========================================================
             FORMULAIRE
        ========================================================== --}}

        <form
            method="POST"
            action="{{ route('password.store') }}"
            class="space-y-5"
        >

            @csrf

            {{-- Token --}}
            <input
                type="hidden"
                name="token"
                value="{{ $request->route('token') }}"
            >


            {{-- =====================================================
                 EMAIL
            ====================================================== --}}

            <div>

                <label
                    for="email"
                    class="block text-sm font-semibold text-gray-700"
                >
                    Adresse email
                </label>

                <div class="mt-2">

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', $request->email) }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="block w-full rounded-xl
                               border border-gray-200
                               bg-gray-50
                               px-4 py-3
                               text-sm text-gray-900
                               placeholder-gray-400
                               shadow-sm
                               outline-none
                               transition
                               focus:border-indigo-500
                               focus:bg-white
                               focus:ring-2
                               focus:ring-indigo-500/20"
                    >

                </div>

                @error('email')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- =====================================================
                 NOUVEAU MOT DE PASSE
            ====================================================== --}}

            <div>

                <label
                    for="password"
                    class="block text-sm font-semibold text-gray-700"
                >
                    Nouveau mot de passe
                </label>

                <div class="mt-2">

                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="new-password"
                        class="block w-full rounded-xl
                               border border-gray-200
                               bg-gray-50
                               px-4 py-3
                               text-sm text-gray-900
                               placeholder-gray-400
                               shadow-sm
                               outline-none
                               transition
                               focus:border-indigo-500
                               focus:bg-white
                               focus:ring-2
                               focus:ring-indigo-500/20"
                    >

                </div>

                @error('password')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- =====================================================
                 CONFIRMATION
            ====================================================== --}}

            <div>

                <label
                    for="password_confirmation"
                    class="block text-sm font-semibold text-gray-700"
                >
                    Confirmer le mot de passe
                </label>

                <div class="mt-2">

                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        class="block w-full rounded-xl
                               border border-gray-200
                               bg-gray-50
                               px-4 py-3
                               text-sm text-gray-900
                               placeholder-gray-400
                               shadow-sm
                               outline-none
                               transition
                               focus:border-indigo-500
                               focus:bg-white
                               focus:ring-2
                               focus:ring-indigo-500/20"
                    >

                </div>

                @error('password_confirmation')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- =====================================================
                 INFORMATION
            ====================================================== --}}

            <div
                class="rounded-xl border border-indigo-100
                       bg-indigo-50 px-4 py-3"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-7 w-7 shrink-0
                               items-center justify-center
                               rounded-lg bg-indigo-100
                               text-indigo-600"
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
                                d="M12 15v2m0-8a4 4 0 00-4 4v2h8v-2a4 4 0 00-4-4zm0 0V7a2 2 0 114 0v2"
                            />
                        </svg>
                    </div>

                    <p class="text-xs leading-5 text-indigo-800">
                        Utilisez un mot de passe suffisamment long et difficile
                        à deviner pour protéger votre compte.
                    </p>

                </div>

            </div>


            {{-- =====================================================
                 BOUTON
            ====================================================== --}}

            <div class="pt-4">

                <button
                    type="submit"
                    style="
                        display: flex !important;
                        width: 100% !important;
                        align-items: center !important;
                        justify-content: center !important;
                        gap: 0.5rem !important;
                        background-color: #4f46e5 !important;
                        color: #ffffff !important;
                        opacity: 1 !important;
                        visibility: visible !important;
                        border: none !important;
                        padding: 0.875rem 1.5rem !important;
                        border-radius: 0.75rem !important;
                        font-size: 0.875rem !important;
                        font-weight: 700 !important;
                        line-height: 1.25rem !important;
                        cursor: pointer !important;
                    "
                    class="group shadow-md transition-all duration-200
                        hover:shadow-lg
                        focus:outline-none
                        focus:ring-2
                        focus:ring-indigo-500
                        focus:ring-offset-2
                        active:scale-[0.98]"
                >

                    <span
                        style="
                            color: #ffffff !important;
                            opacity: 1 !important;
                            visibility: visible !important;
                        "
                    >
                        Réinitialiser mon mot de passe
                    </span>

                    <svg
                        class="h-4 w-4 transition-transform group-hover:translate-x-1"
                        style="
                            color: #ffffff !important;
                            fill: none !important;
                            stroke: #ffffff !important;
                            opacity: 1 !important;
                            visibility: visible !important;
                        "
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6"
                        />
                    </svg>

                </button>

            </div>


            {{-- =====================================================
                 RETOUR
            ====================================================== --}}

            <div class="pt-2 text-center">

                <a
                    href="{{ route('login') }}"
                    class="inline-flex items-center gap-2
                           text-sm font-medium
                           text-gray-500
                           transition
                           hover:text-indigo-600"
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
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        />
                    </svg>

                    Retour à la connexion

                </a>

            </div>

        </form>

    </div>

</x-guest-layout>