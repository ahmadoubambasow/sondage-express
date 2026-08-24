<x-guest-layout>

    <div class="min-h-[calc(100vh-2rem)] flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">

            {{-- =========================================================
                 LOGO
            ========================================================== --}}

            <div class="text-center mb-8">

                <a
                    href="{{ url('/') }}"
                    class="inline-flex items-center gap-2"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center
                               rounded-xl bg-indigo-600 text-white
                               text-xl font-bold shadow-sm"
                    >
                        S
                    </div>

                    <span class="text-2xl font-bold text-gray-900">
                        Sondage<span class="text-indigo-600">Express</span>
                    </span>

                </a>

                <h1 class="mt-7 text-2xl font-bold tracking-tight text-gray-900">
                    Bon retour 👋
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Connectez-vous pour gérer vos sondages.
                </p>

            </div>


            {{-- =========================================================
                 MESSAGE SESSION
            ========================================================== --}}

            <x-auth-session-status
                class="mb-5"
                :status="session('status')"
            />


            {{-- =========================================================
                 CARTE
            ========================================================== --}}

            <div
                class="rounded-2xl border border-gray-100
                       bg-white p-6 shadow-lg
                       sm:p-8"
            >

                <form
                    method="POST"
                    action="{{ route('login') }}"
                    class="space-y-6"
                >

                    @csrf


                    {{-- =================================================
                         EMAIL
                    ================================================== --}}

                    <div>

                        <label
                            for="email"
                            class="block text-sm font-semibold text-gray-700"
                        >
                            Adresse email
                        </label>

                        <div class="relative mt-2">

                            <div
                                class="pointer-events-none absolute inset-y-0
                                       left-0 flex items-center pl-3"
                            >

                                <svg
                                    class="h-5 w-5 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 8l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"
                                    />
                                </svg>

                            </div>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="vous@exemple.com"
                                class="block w-full rounded-lg
                                       border border-gray-200
                                       bg-gray-50
                                       py-3.5 pl-10 pr-4
                                       text-sm text-gray-900
                                       placeholder-gray-400
                                       outline-none
                                       transition
                                       focus:border-indigo-500
                                       focus:bg-white
                                       focus:ring-2
                                       focus:ring-indigo-100"
                            >

                        </div>

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />

                    </div>


                    {{-- =================================================
                         MOT DE PASSE
                    ================================================== --}}

                    <div>

                        <div class="flex items-center justify-between">

                            <label
                                for="password"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Mot de passe
                            </label>

                            @if (Route::has('password.request'))

                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-sm font-medium
                                           text-indigo-600
                                           transition hover:text-indigo-700"
                                >
                                    Mot de passe oublié ?
                                </a>

                            @endif

                        </div>


                        <div class="relative mt-2">

                            <div
                                class="pointer-events-none absolute inset-y-0
                                       left-0 flex items-center pl-3"
                            >

                                <svg
                                    class="h-5 w-5 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                    />
                                </svg>

                            </div>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="block w-full rounded-lg
                                       border border-gray-200
                                       bg-gray-50
                                       py-3.5 pl-10 pr-4
                                       text-sm text-gray-900
                                       placeholder-gray-400
                                       outline-none
                                       transition
                                       focus:border-indigo-500
                                       focus:bg-white
                                       focus:ring-2
                                       focus:ring-indigo-100"
                            >

                        </div>

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />

                    </div>


                    {{-- =================================================
                         REMEMBER ME
                    ================================================== --}}

                    <div class="flex items-center">

                        <label
                            for="remember_me"
                            class="inline-flex cursor-pointer items-center"
                        >

                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                                class="h-4 w-4 rounded
                                       border-gray-300
                                       text-indigo-600
                                       shadow-sm
                                       focus:ring-indigo-500"
                            >

                            <span class="ms-2 text-sm text-gray-600">
                                Se souvenir de moi
                            </span>

                        </label>

                    </div>


                    {{-- =================================================
                         BOUTON CONNEXION
                    ================================================== --}}

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
                            line-height: 1.5;
                            cursor: pointer;
                            box-shadow: 0 4px 6px rgba(0,0,0,0.08);
                        "
                    >
                        <span style="color: #ffffff !important;">
                            Se connecter
                        </span>

                        <svg
                            style="
                                width: 16px;
                                height: 16px;
                                color: #ffffff;
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

                </form>


                {{-- =========================================================
                     INSCRIPTION
                ========================================================== --}}

                <div class="mt-7 border-t border-gray-100 pt-6 text-center">

                    <p class="text-sm text-gray-500">
                        Vous n'avez pas encore de compte ?
                    </p>

                    <a
                        href="{{ route('register') }}"
                        class="mt-2 inline-block text-sm font-semibold
                               text-indigo-600 transition
                               hover:text-indigo-700"
                    >
                        Créer un compte gratuitement
                    </a>

                </div>

            </div>


            {{-- =========================================================
                 RETOUR ACCUEIL
            ========================================================== --}}

            <div class="mt-6 text-center">

                <a
                    href="{{ url('/') }}"
                    class="inline-flex items-center gap-2
                           text-sm font-medium text-gray-500
                           transition hover:text-indigo-600"
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

                    Retour à l'accueil

                </a>

            </div>

        </div>

    </div>

</x-guest-layout>