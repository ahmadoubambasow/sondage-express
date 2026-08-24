<x-guest-layout>

    {{-- =========================================================
        EN-TÊTE
    ========================================================== --}}

    <div class="mb-8 text-center">

        {{-- Logo --}}
        <div
            class="mx-auto flex h-12 w-12 items-center justify-center
                   rounded-xl bg-indigo-600 text-xl font-bold text-white
                   shadow-sm"
        >
            S
        </div>

        <h1 class="mt-5 text-2xl font-bold tracking-tight text-gray-900">
            Mot de passe oublié ?
        </h1>

        <p class="mt-2 text-sm leading-6 text-gray-500">
            Pas de problème. Entrez votre adresse e-mail et nous vous
            enverrons un lien pour réinitialiser votre mot de passe.
        </p>

    </div>


    {{-- =========================================================
        MESSAGE DE SESSION
    ========================================================== --}}

    <x-auth-session-status
        class="mb-5"
        :status="session('status')"
    />


    {{-- =========================================================
        FORMULAIRE
    ========================================================== --}}

    <form
        method="POST"
        action="{{ route('password.email') }}"
        class="space-y-5"
    >

        @csrf


        {{-- Email --}}
        <div>

            <label
                for="email"
                class="block text-sm font-semibold text-gray-700"
            >
                Adresse e-mail
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="email"
                placeholder="vous@exemple.com"
                class="mt-2 block w-full rounded-lg
                       border border-gray-300
                       bg-white px-4 py-3
                       text-sm text-gray-900
                       placeholder-gray-400
                       shadow-sm
                       outline-none
                       transition
                       focus:border-indigo-500
                       focus:ring-2
                       focus:ring-indigo-500/20"
            >

            @error('email')
                <p class="mt-2 text-sm font-medium text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- =====================================================
             BOUTON
        ====================================================== --}}

        <div class="pt-2">

            <button
                type="submit"
                style="
                    display: flex;
                    width: 100%;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                    padding: 14px 24px;
                    background-color: #4f46e5;
                    color: #ffffff !important;
                    border: none;
                    border-radius: 8px;
                    font-size: 14px;
                    font-weight: 700;
                    line-height: 20px;
                    cursor: pointer;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
                "
                onmouseover="this.style.backgroundColor='#4338ca'"
                onmouseout="this.style.backgroundColor='#4f46e5'"
            >

                <span
                    style="
                        color: #ffffff !important;
                        display: inline-block;
                    "
                >
                    Envoyer le lien de réinitialisation
                </span>

                <svg
                    style="
                        width: 16px;
                        height: 16px;
                        color: #ffffff !important;
                        stroke: #ffffff !important;
                        flex-shrink: 0;
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

    </form>


    {{-- =========================================================
        RETOUR CONNEXION
    ========================================================== --}}

    <div class="mt-7 border-t border-gray-100 pt-6 text-center">

        <a
            href="{{ route('login') }}"
            class="inline-flex items-center gap-2
                   text-sm font-semibold text-indigo-600
                   transition hover:text-indigo-700"
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

            Retour à la connexion

        </a>

    </div>

</x-guest-layout>