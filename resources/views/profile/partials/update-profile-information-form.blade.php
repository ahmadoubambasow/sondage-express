<section>

    {{-- =========================================================
        EN-TÊTE
    ========================================================== --}}

    <div class="flex items-start gap-4">

        {{-- Icône --}}
        <div
            class="flex h-11 w-11 shrink-0 items-center justify-center
                   rounded-xl bg-indigo-50 text-indigo-600"
        >
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
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                />
            </svg>
        </div>

        <div>
            <h2 class="text-lg font-bold text-gray-900">
                Informations du profil
            </h2>

            <p class="mt-1 text-sm leading-6 text-gray-500">
                Modifiez vos informations personnelles et votre adresse email.
            </p>
        </div>

    </div>


    {{-- =========================================================
        FORMULAIRE DE VÉRIFICATION
    ========================================================== --}}

    <form
        id="send-verification"
        method="post"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>


    {{-- =========================================================
        FORMULAIRE
    ========================================================== --}}

    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="mt-8 space-y-6"
    >

        @csrf
        @method('patch')


        {{-- =====================================================
             NOM
        ====================================================== --}}

        <div>

            <label
                for="name"
                class="block text-sm font-semibold text-gray-700"
            >
                Nom
            </label>

            <div class="relative mt-2">

                <div
                    class="pointer-events-none absolute inset-y-0 left-0
                           flex items-center pl-3 text-gray-400"
                >
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
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                        />
                    </svg>
                </div>

                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                    class="block w-full rounded-xl border-gray-200
                           bg-gray-50 py-3 pl-10 pr-4 text-sm
                           text-gray-900
                           placeholder-gray-400
                           transition
                           focus:border-indigo-500
                           focus:bg-white
                           focus:ring-2
                           focus:ring-indigo-500/20"
                    placeholder="Votre nom"
                >

            </div>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />

        </div>


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

            <div class="relative mt-2">

                <div
                    class="pointer-events-none absolute inset-y-0 left-0
                           flex items-center pl-3 text-gray-400"
                >
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
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                        />
                    </svg>
                </div>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                    class="block w-full rounded-xl border-gray-200
                           bg-gray-50 py-3 pl-10 pr-4 text-sm
                           text-gray-900
                           transition
                           focus:border-indigo-500
                           focus:bg-white
                           focus:ring-2
                           focus:ring-indigo-500/20"
                    placeholder="vous@exemple.com"
                >

            </div>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />


            {{-- =================================================
                 EMAIL NON VÉRIFIÉ
            ================================================== --}}

            @if (
                $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail
                && ! $user->hasVerifiedEmail()
            )

                <div
                    class="mt-4 rounded-xl border border-amber-200
                           bg-amber-50 p-4"
                >

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-9 w-9 shrink-0 items-center
                                   justify-center rounded-lg
                                   bg-amber-100 text-amber-600"
                        >
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
                                    d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"
                                />
                            </svg>
                        </div>

                        <div>

                            <p class="text-sm font-semibold text-amber-800">
                                Adresse email non vérifiée
                            </p>

                            <p class="mt-1 text-sm leading-5 text-amber-700">
                                Vérifiez votre adresse email pour sécuriser
                                votre compte.
                            </p>

                            <button
                                form="send-verification"
                                type="submit"
                                class="mt-3 inline-flex items-center
                                       gap-2 text-sm font-semibold
                                       text-indigo-600
                                       transition hover:text-indigo-800
                                       focus:outline-none"
                            >

                                Renvoyer l'email de vérification

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
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"
                                    />
                                </svg>

                            </button>

                        </div>

                    </div>

                </div>


                @if (session('status') === 'verification-link-sent')

                    <div
                        class="mt-3 flex items-center gap-2
                               rounded-xl border border-green-200
                               bg-green-50 p-3 text-sm
                               font-medium text-green-700"
                    >

                        <span
                            class="flex h-6 w-6 items-center justify-center
                                   rounded-full bg-green-100"
                        >
                            ✓
                        </span>

                        Un nouvel email de vérification a été envoyé.

                    </div>

                @endif

            @endif

        </div>


        {{-- =====================================================
             SÉPARATEUR
        ====================================================== --}}

        <div class="border-t border-gray-100"></div>


        {{-- =====================================================
             ACTIONS
        ====================================================== --}}

        <div
            class="flex flex-col gap-4 sm:flex-row sm:items-center
                   sm:justify-between"
        >

            <p class="text-xs text-gray-400">
                Vos informations sont utilisées uniquement pour votre compte.
            </p>


            <div class="flex items-center gap-4">

                <button
                    type="submit"
                    style="
                        display: inline-flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        gap: 8px !important;

                        background-color: #4f46e5 !important;
                        color: #ffffff !important;

                        padding: 12px 20px !important;

                        font-size: 14px !important;
                        font-weight: 700 !important;

                        border: none !important;
                        border-radius: 12px !important;

                        box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;

                        cursor: pointer !important;

                        transition: all 0.2s ease !important;
                        "
                        onmouseover="this.style.backgroundColor='#4338ca'"
                        onmouseout="this.style.backgroundColor='#4f46e5'"
                    >
                    <span
                        style="
                            color: #ffffff !important;
                            display: inline-block !important;
                        "
                    >
                        Enregistrer
                    </span>

                    <svg
                        style="
                            width: 16px !important;
                            height: 16px !important;
                            color: #ffffff !important;
                            fill: none !important;
                            display: block !important;
                        "
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
                </button>


                @if (session('status') === 'profile-updated')

                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2500)"
                        class="flex items-center gap-1.5 text-sm
                               font-medium text-green-600"
                    >

                        <span>✓</span>

                        Modifications enregistrées

                    </p>

                @endif

            </div>

        </div>

    </form>

</section>