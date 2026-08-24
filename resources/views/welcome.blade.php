<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Sondage Express</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    {{-- =========================================================
        NAVIGATION
    ========================================================== --}}
    <header class="bg-white border-b border-gray-100">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <a
                    href="{{ url('/') }}"
                    class="flex items-center gap-2"
                >
                    <div
                        class="flex items-center justify-center w-9 h-9 rounded-lg bg-indigo-600 text-white font-bold"
                    >
                        S
                    </div>

                    <span class="text-xl font-bold text-gray-900">
                        Sondage<span class="text-indigo-600">Express</span>
                    </span>
                </a>

                {{-- Navigation --}}
                <nav class="flex items-center gap-3">

                    @auth

                        <a
                            href="{{ route('dashboard') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 transition"
                        >
                            Mes sondages
                        </a>

                        <a
                            href="{{ route('polls.create') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition"
                        >
                            Créer un sondage
                        </a>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 transition"
                        >
                            Connexion
                        </a>

                        <a
                            href="{{ route('register') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition"
                        >
                            Créer un compte
                        </a>

                    @endauth

                </nav>

            </div>

        </div>

    </header>


    {{-- =========================================================
        HERO
    ========================================================== --}}
    <main>

        <section class="relative overflow-hidden">

            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="grid lg:grid-cols-2 gap-12 items-center py-20 lg:py-28">

                    {{-- Texte --}}
                    <div class="max-w-2xl">

                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 mb-6 text-sm font-medium text-indigo-700 bg-indigo-50 rounded-full"
                        >
                            <span class="w-2 h-2 bg-indigo-600 rounded-full"></span>

                            Simple. Rapide. Efficace.
                        </div>

                        <h1
                            class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900"
                        >
                            Créez un sondage.
                            <span class="text-indigo-600">
                                Obtenez des réponses.
                            </span>
                        </h1>

                        <p class="mt-6 text-lg leading-8 text-gray-600 max-w-xl">
                            Créez rapidement une question, ajoutez vos options,
                            partagez votre sondage et découvrez l'avis de votre
                            communauté en quelques clics.
                        </p>

                        {{-- Boutons --}}
                        <div class="mt-8 flex flex-wrap gap-4">

                            @auth

                                <a
                                    href="{{ route('polls.create') }}"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition shadow-sm"
                                >
                                    Créer un sondage
                                </a>

                                <a
                                    href="{{ route('dashboard') }}"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg border border-gray-200 hover:bg-gray-50 transition"
                                >
                                    Mes sondages
                                </a>

                            @else

                                <a
                                    href="{{ route('register') }}"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition shadow-sm"
                                >
                                    Commencer gratuitement
                                </a>

                                <a
                                    href="{{ route('login') }}"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg border border-gray-200 hover:bg-gray-50 transition"
                                >
                                    Se connecter
                                </a>

                            @endauth

                        </div>

                    </div>


                    {{-- Illustration --}}
                    <div class="hidden lg:block">

                        <div class="relative max-w-md mx-auto">

                            {{-- Carte principale --}}
                            <div
                                class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6"
                            >

                                <div class="flex items-center justify-between mb-6">

                                    <div>

                                        <p class="text-xs text-gray-400 uppercase tracking-wide">
                                            Exemple de sondage
                                        </p>

                                        <h2 class="mt-1 text-lg font-bold text-gray-900">
                                            Quel framework préférez-vous ?
                                        </h2>

                                    </div>

                                    <div
                                        class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold"
                                    >
                                        ?
                                    </div>

                                </div>


                                {{-- Option 1 --}}
                                <div class="mb-4">

                                    <div class="flex justify-between text-sm mb-2">

                                        <span class="font-medium">
                                            Laravel
                                        </span>

                                        <span class="text-gray-500">
                                            52%
                                        </span>

                                    </div>

                                    <div class="h-3 bg-gray-100 rounded-full overflow-hidden">

                                        <div
                                            class="h-full w-[52%] bg-indigo-600 rounded-full"
                                        ></div>

                                    </div>

                                </div>


                                {{-- Option 2 --}}
                                <div class="mb-4">

                                    <div class="flex justify-between text-sm mb-2">

                                        <span class="font-medium">
                                            Symfony
                                        </span>

                                        <span class="text-gray-500">
                                            31%
                                        </span>

                                    </div>

                                    <div class="h-3 bg-gray-100 rounded-full overflow-hidden">

                                        <div
                                            class="h-full w-[31%] bg-indigo-400 rounded-full"
                                        ></div>

                                    </div>

                                </div>


                                {{-- Option 3 --}}
                                <div>

                                    <div class="flex justify-between text-sm mb-2">

                                        <span class="font-medium">
                                            Node.js
                                        </span>

                                        <span class="text-gray-500">
                                            17%
                                        </span>

                                    </div>

                                    <div class="h-3 bg-gray-100 rounded-full overflow-hidden">

                                        <div
                                            class="h-full w-[17%] bg-indigo-300 rounded-full"
                                        ></div>

                                    </div>

                                </div>


                                <div
                                    class="mt-6 pt-5 border-t border-gray-100 flex justify-between text-sm"
                                >

                                    <span class="text-gray-500">
                                        124 votes
                                    </span>

                                    <span class="font-medium text-green-600">
                                        En cours
                                    </span>

                                </div>

                            </div>

                            {{-- Petite carte --}}
                            <div
                                class="absolute -bottom-6 -left-10 bg-white rounded-xl shadow-lg border border-gray-100 px-5 py-4"
                            >

                                <p class="text-xs text-gray-400">
                                    Participation
                                </p>

                                <p class="mt-1 text-2xl font-bold text-gray-900">
                                    124
                                </p>

                                <p class="text-xs text-green-600">
                                    votes enregistrés
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =========================================================
            COMMENT ÇA MARCHE
        ========================================================== --}}
        <section class="bg-white border-y border-gray-100">

            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">

                <div class="text-center max-w-2xl mx-auto">

                    <p class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">
                        Comment ça marche ?
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-gray-900">
                        Trois étapes, c'est tout.
                    </h2>

                    <p class="mt-4 text-gray-600">
                        Pas besoin d'une configuration compliquée.
                        Créez votre sondage et commencez à recueillir des réponses.
                    </p>

                </div>


                <div class="mt-12 grid md:grid-cols-3 gap-8">

                    {{-- Étape 1 --}}
                    <div class="text-center">

                        <div
                            class="mx-auto w-12 h-12 flex items-center justify-center rounded-xl bg-indigo-100 text-indigo-600 font-bold text-lg"
                        >
                            1
                        </div>

                        <h3 class="mt-5 text-lg font-semibold text-gray-900">
                            Créez
                        </h3>

                        <p class="mt-2 text-gray-600 leading-6">
                            Posez votre question, ajoutez une description
                            et définissez les différentes options.
                        </p>

                    </div>


                    {{-- Étape 2 --}}
                    <div class="text-center">

                        <div
                            class="mx-auto w-12 h-12 flex items-center justify-center rounded-xl bg-indigo-100 text-indigo-600 font-bold text-lg"
                        >
                            2
                        </div>

                        <h3 class="mt-5 text-lg font-semibold text-gray-900">
                            Partagez
                        </h3>

                        <p class="mt-2 text-gray-600 leading-6">
                            Copiez le lien de votre sondage et partagez-le
                            avec les personnes que vous souhaitez interroger.
                        </p>

                    </div>


                    {{-- Étape 3 --}}
                    <div class="text-center">

                        <div
                            class="mx-auto w-12 h-12 flex items-center justify-center rounded-xl bg-indigo-100 text-indigo-600 font-bold text-lg"
                        >
                            3
                        </div>

                        <h3 class="mt-5 text-lg font-semibold text-gray-900">
                            Consultez
                        </h3>

                        <p class="mt-2 text-gray-600 leading-6">
                            Consultez les votes et visualisez facilement
                            les résultats de votre sondage.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        {{-- =========================================================
            AVANTAGES
        ========================================================== --}}
        <section>

            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div class="bg-white p-6 rounded-xl border border-gray-100">

                        <div class="text-2xl">
                            ⚡
                        </div>

                        <h3 class="mt-4 font-semibold text-gray-900">
                            Rapide
                        </h3>

                        <p class="mt-2 text-sm text-gray-600 leading-6">
                            Créez votre sondage en quelques secondes.
                        </p>

                    </div>


                    <div class="bg-white p-6 rounded-xl border border-gray-100">

                        <div class="text-2xl">
                            🔗
                        </div>

                        <h3 class="mt-4 font-semibold text-gray-900">
                            Facile à partager
                        </h3>

                        <p class="mt-2 text-sm text-gray-600 leading-6">
                            Un simple lien suffit pour inviter les participants.
                        </p>

                    </div>


                    <div class="bg-white p-6 rounded-xl border border-gray-100">

                        <div class="text-2xl">
                            📊
                        </div>

                        <h3 class="mt-4 font-semibold text-gray-900">
                            Résultats clairs
                        </h3>

                        <p class="mt-2 text-sm text-gray-600 leading-6">
                            Visualisez les résultats de manière simple et lisible.
                        </p>

                    </div>


                    <div class="bg-white p-6 rounded-xl border border-gray-100">

                        <div class="text-2xl">
                            📱
                        </div>

                        <h3 class="mt-4 font-semibold text-gray-900">
                            Accessible partout
                        </h3>

                        <p class="mt-2 text-sm text-gray-600 leading-6">
                            Une interface adaptée aux ordinateurs et aux mobiles.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        {{-- =========================================================
            CTA FINAL
        ========================================================== --}}
        <section class="bg-indigo-600">

            <div class="max-w-4xl mx-auto px-6 lg:px-8 py-16 text-center">

                <h2 class="text-3xl font-bold text-white">
                    Prêt à connaître l'avis de votre communauté ?
                </h2>

                <p class="mt-4 text-indigo-100 text-lg">
                    Créez votre premier sondage et commencez à recueillir
                    des réponses dès maintenant.
                </p>

                <div class="mt-8">

                    @auth

                        <a
                            href="{{ route('polls.create') }}"
                            class="inline-flex items-center px-6 py-3 bg-white text-indigo-700 font-semibold rounded-lg hover:bg-gray-100 transition"
                        >
                            Créer mon sondage
                        </a>

                    @else

                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center px-6 py-3 bg-white text-indigo-700 font-semibold rounded-lg hover:bg-gray-100 transition"
                        >
                            Créer mon compte
                        </a>

                    @endauth

                </div>

            </div>

        </section>

    </main>


    {{-- =========================================================
        FOOTER
    ========================================================== --}}
    <footer class="bg-white border-t border-gray-100">

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">

                <p class="text-sm text-gray-500">
                    © {{ date('Y') }} Sondage Express.
                    Tous droits réservés.
                </p>

                <p class="text-sm text-gray-400">
                    Simple. Rapide. Efficace.
                </p>

            </div>

        </div>

    </footer>

</body>

</html>