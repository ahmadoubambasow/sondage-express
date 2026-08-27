<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Réinitialisation du mot de passe</title>
</head>

<body
    style="
        margin: 0;
        padding: 0;
        background-color: #f9fafb;
        font-family: Arial, Helvetica, sans-serif;
        color: #111827;
    "
>

    <table
        width="100%"
        cellpadding="0"
        cellspacing="0"
        border="0"
        style="padding: 40px 15px;"
    >

        <tr>

            <td align="center">

                <table
                    width="100%"
                    cellpadding="0"
                    cellspacing="0"
                    border="0"
                    style="
                        max-width: 560px;
                        background-color: #ffffff;
                        border: 1px solid #e5e7eb;
                        border-radius: 16px;
                        overflow: hidden;
                    "
                >

                    {{-- =====================================================
                         LOGO
                    ====================================================== --}}

                    <tr>

                        <td
                            align="center"
                            style="padding: 32px 30px 20px;"
                        >

                            <div
                                style="
                                    display: inline-block;
                                    font-size: 24px;
                                    font-weight: 700;
                                    color: #111827;
                                "
                            >
                                Sondage<span style="color: #4f46e5;">
                                    Express
                                </span>
                            </div>

                        </td>

                    </tr>


                    {{-- =====================================================
                         CONTENU
                    ====================================================== --}}

                    <tr>

                        <td
                            style="
                                padding: 20px 35px 35px;
                            "
                        >

                            <h1
                                style="
                                    margin: 0 0 20px;
                                    font-size: 24px;
                                    line-height: 1.3;
                                    font-weight: 700;
                                    color: #111827;
                                "
                            >
                                Réinitialisation de votre mot de passe
                            </h1>


                            <p
                                style="
                                    margin: 0 0 16px;
                                    font-size: 15px;
                                    line-height: 1.7;
                                    color: #4b5563;
                                "
                            >
                                Bonjour {{ $user->name }},
                            </p>


                            <p
                                style="
                                    margin: 0 0 16px;
                                    font-size: 15px;
                                    line-height: 1.7;
                                    color: #4b5563;
                                "
                            >
                                Vous avez demandé la réinitialisation de
                                votre mot de passe sur
                                <strong>Sondage Express</strong>.
                            </p>


                            <p
                                style="
                                    margin: 0 0 28px;
                                    font-size: 15px;
                                    line-height: 1.7;
                                    color: #4b5563;
                                "
                            >
                                Cliquez sur le bouton ci-dessous pour définir
                                un nouveau mot de passe.
                            </p>


                            {{-- =================================================
                                 BOUTON
                            ================================================== --}}

                            <table
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                                width="100%"
                            >

                                <tr>

                                    <td align="center">

                                        <a
                                            href="{{ $url }}"
                                            style="
                                                display: inline-block;
                                                padding: 13px 24px;
                                                background-color: #4f46e5;
                                                color: #ffffff;
                                                text-decoration: none;
                                                border-radius: 8px;
                                                font-size: 14px;
                                                font-weight: 700;
                                            "
                                        >
                                            Réinitialiser mon mot de passe
                                        </a>

                                    </td>

                                </tr>

                            </table>


                            {{-- =================================================
                                 INFORMATION
                            ================================================== --}}

                            <div
                                style="
                                    margin-top: 30px;
                                    padding: 15px;
                                    background-color: #f9fafb;
                                    border: 1px solid #e5e7eb;
                                    border-radius: 8px;
                                "
                            >

                                <p
                                    style="
                                        margin: 0;
                                        font-size: 13px;
                                        line-height: 1.6;
                                        color: #6b7280;
                                    "
                                >
                                    Ce lien de réinitialisation est valable
                                    pendant une durée limitée.
                                </p>

                            </div>


                            <p
                                style="
                                    margin: 25px 0 0;
                                    font-size: 13px;
                                    line-height: 1.6;
                                    color: #6b7280;
                                "
                            >
                                Si vous n'êtes pas à l'origine de cette
                                demande, vous pouvez ignorer cet email.
                                Votre mot de passe restera inchangé.
                            </p>


                            <p
                                style="
                                    margin: 28px 0 0;
                                    font-size: 14px;
                                    line-height: 1.6;
                                    color: #374151;
                                "
                            >
                                À bientôt,<br>

                                <strong>
                                    L'équipe Sondage Express
                                </strong>
                            </p>

                        </td>

                    </tr>


                    {{-- =====================================================
                         FOOTER
                    ====================================================== --}}

                    <tr>

                        <td
                            align="center"
                            style="
                                padding: 20px 30px;
                                background-color: #f9fafb;
                                border-top: 1px solid #e5e7eb;
                            "
                        >

                            <p
                                style="
                                    margin: 0;
                                    font-size: 12px;
                                    color: #9ca3af;
                                "
                            >
                                © {{ date('Y') }} Sondage Express.
                                Tous droits réservés.
                            </p>

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>

</body>

</html>