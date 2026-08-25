<section class="space-y-6">

    {{-- =========================================================
         EN-TÊTE
    ========================================================== --}}

    <header>

        <div class="flex items-start gap-4">

            {{-- Icône danger --}}
            <div
                class="flex h-11 w-11 shrink-0 items-center justify-center
                       rounded-xl bg-red-50 text-red-600"
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
                        d="M12 9v4m0 4h.01M10.29 3.86l-7.36 12.75A2 2 0 004.66 20h14.68a2 2 0 001.73-3.39L13.71 3.86a2 2 0 00-3.42 0z"
                    />
                </svg>
            </div>

            <div>

                <h2 class="text-lg font-semibold text-gray-900">
                    Supprimer le compte
                </h2>

                <p class="mt-1 text-sm leading-6 text-gray-500">
                    La suppression de votre compte est définitive.
                    Toutes vos données et vos ressources seront
                    définitivement supprimées.
                </p>

            </div>

        </div>

    </header>


    {{-- =========================================================
         AVERTISSEMENT
    ========================================================== --}}

    <div
        class="rounded-xl border border-red-100
               bg-red-50 p-4"
    >

        <div class="flex items-start gap-3">

            <svg
                class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 9v4m0 4h.01M10.29 3.86l-7.36 12.75A2 2 0 004.66 20h14.68a2 2 0 001.73-3.39L13.71 3.86a2 2 0 00-3.42 0z"
                />
            </svg>

            <div>

                <p class="text-sm font-semibold text-red-800">
                    Attention
                </p>

                <p class="mt-1 text-sm leading-6 text-red-700">
                    Avant de supprimer votre compte, assurez-vous
                    d'avoir téléchargé ou sauvegardé les informations
                    que vous souhaitez conserver.
                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
         BOUTON SUPPRESSION
    ========================================================== --}}

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        style="
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;

            background-color: #dc2626 !important;
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
        onmouseover="this.style.backgroundColor='#b91c1c'"
        onmouseout="this.style.backgroundColor='#dc2626'"
    >

        <svg
            style="
                width: 16px !important;
                height: 16px !important;
                color: #ffffff !important;
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
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-8 0h10"
            />
        </svg>

        <span style="color: #ffffff !important;">
            Supprimer mon compte
        </span>

    </button>


    {{-- =========================================================
         MODALE DE CONFIRMATION
    ========================================================== --}}

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >

        <form
            method="post"
            action="{{ route('profile.destroy') }}"
            class="p-6"
        >

            @csrf
            @method('delete')


            {{-- En-tête modal --}}

            <div class="flex items-start gap-4">

                <div
                    class="flex h-10 w-10 shrink-0 items-center
                           justify-center rounded-full bg-red-50
                           text-red-600"
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
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.36 12.75A2 2 0 004.66 20h14.68a2 2 0 001.73-3.39L13.71 3.86a2 2 0 00-3.42 0z"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-gray-900">
                        Confirmer la suppression
                    </h2>

                    <p class="mt-1 text-sm leading-6 text-gray-500">
                        Êtes-vous sûr de vouloir supprimer définitivement
                        votre compte ?
                    </p>

                </div>

            </div>


            {{-- Message --}}

            <div
                class="mt-5 rounded-lg bg-gray-50
                       border border-gray-100 p-4"
            >

                <p class="text-sm leading-6 text-gray-600">
                    Cette action est irréversible. Toutes vos données,
                    vos sondages et les informations associées à votre
                    compte seront définitivement supprimés.
                </p>

            </div>


            {{-- Mot de passe --}}

            <div class="mt-6">

                <label
                    for="password"
                    class="block text-sm font-medium text-gray-700"
                >
                    Mot de passe
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-2 block w-full rounded-xl
                           border-gray-200
                           bg-gray-50
                           px-4 py-3
                           text-sm text-gray-900
                           shadow-sm
                           transition
                           focus:border-red-500
                           focus:bg-white
                           focus:ring-2
                           focus:ring-red-500/20"
                    placeholder="Entrez votre mot de passe"
                >

                <p class="mt-2 text-xs text-gray-500">
                    Votre mot de passe est nécessaire pour confirmer
                    cette action.
                </p>

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2"
                />

            </div>


            {{-- =====================================================
                 ACTIONS
            ====================================================== --}}

            <div
                class="mt-7 flex flex-col-reverse
                       gap-3 sm:flex-row sm:justify-end"
            >

                {{-- Annuler --}}

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    style="
                        display: inline-flex !important;
                        align-items: center !important;
                        justify-content: center !important;

                        background-color: #ffffff !important;
                        color: #374151 !important;

                        padding: 10px 18px !important;

                        font-size: 14px !important;
                        font-weight: 600 !important;

                        border: 1px solid #e5e7eb !important;
                        border-radius: 10px !important;

                        cursor: pointer !important;
                    "
                >
                    Annuler
                </button>


                {{-- Confirmer suppression --}}

                <button
                    type="submit"
                    style="
                        display: inline-flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        gap: 8px !important;

                        background-color: #dc2626 !important;
                        color: #ffffff !important;

                        padding: 10px 18px !important;

                        font-size: 14px !important;
                        font-weight: 700 !important;

                        border: none !important;
                        border-radius: 10px !important;

                        cursor: pointer !important;
                    "
                    onmouseover="this.style.backgroundColor='#b91c1c'"
                    onmouseout="this.style.backgroundColor='#dc2626'"
                >

                    <svg
                        style="
                            width: 16px !important;
                            height: 16px !important;
                            color: #ffffff !important;
                        "
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-8 0h10"
                        />
                    </svg>

                    <span style="color: #ffffff !important;">
                        Supprimer définitivement
                    </span>

                </button>

            </div>

        </form>

    </x-modal>

</section>