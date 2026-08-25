<section>
    {{-- =========================================================
         EN-TÊTE
    ========================================================== --}}

    <header class="mb-8">

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
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v2h8z"
                    />
                </svg>
            </div>

            <div>

                <h2 class="text-lg font-semibold text-gray-900">
                    {{ __('Update Password') }}
                </h2>

                <p class="mt-1 text-sm leading-6 text-gray-500">
                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                </p>

            </div>

        </div>

    </header>


    {{-- =========================================================
         FORMULAIRE
    ========================================================== --}}

    <form
        method="post"
        action="{{ route('password.update') }}"
        class="space-y-6"
    >

        @csrf
        @method('put')


        {{-- =====================================================
             MOT DE PASSE ACTUEL
        ====================================================== --}}

        <div>

            <x-input-label
                for="update_password_current_password"
                :value="__('Current Password')"
                class="font-medium text-gray-700"
            />

            <div class="relative mt-2">

                <input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    autocomplete="current-password"
                    class="block w-full rounded-xl
                           border-gray-200
                           bg-gray-50
                           px-4 py-3
                           text-sm text-gray-900
                           shadow-sm
                           transition
                           placeholder:text-gray-400
                           focus:border-indigo-500
                           focus:bg-white
                           focus:ring-2
                           focus:ring-indigo-500/20"
                >

            </div>

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2"
            />

        </div>


        {{-- =====================================================
             NOUVEAU MOT DE PASSE
        ====================================================== --}}

        <div>

            <x-input-label
                for="update_password_password"
                :value="__('New Password')"
                class="font-medium text-gray-700"
            />

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="mt-2 block w-full rounded-xl
                       border-gray-200
                       bg-gray-50
                       px-4 py-3
                       text-sm text-gray-900
                       shadow-sm
                       transition
                       placeholder:text-gray-400
                       focus:border-indigo-500
                       focus:bg-white
                       focus:ring-2
                       focus:ring-indigo-500/20"
            >

            <p class="mt-2 text-xs text-gray-500">
                Utilisez un mot de passe suffisamment long et difficile à deviner.
            </p>

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2"
            />

        </div>


        {{-- =====================================================
             CONFIRMATION
        ====================================================== --}}

        <div>

            <x-input-label
                for="update_password_password_confirmation"
                :value="__('Confirm Password')"
                class="font-medium text-gray-700"
            />

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="mt-2 block w-full rounded-xl
                       border-gray-200
                       bg-gray-50
                       px-4 py-3
                       text-sm text-gray-900
                       shadow-sm
                       transition
                       placeholder:text-gray-400
                       focus:border-indigo-500
                       focus:bg-white
                       focus:ring-2
                       focus:ring-indigo-500/20"
            >

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2"
            />

        </div>


        {{-- =====================================================
             ACTION
        ====================================================== --}}

        <div
            class="flex flex-col sm:flex-row
                   sm:items-center gap-4
                   pt-2"
        >

            {{-- Bouton --}}
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

                <span style="color: #ffffff !important;">
                    {{ __('Save') }}
                </span>

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
                        d="M5 13l4 4L19 7"
                    />
                </svg>

            </button>


            {{-- Confirmation --}}
            @if (session('status') === 'password-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="inline-flex items-center gap-2
                           text-sm font-medium text-green-600"
                >

                    <span
                        class="flex h-6 w-6 items-center justify-center
                               rounded-full bg-green-50"
                    >
                        ✓
                    </span>

                    {{ __('Saved.') }}

                </p>

            @endif

        </div>

    </form>

</section>