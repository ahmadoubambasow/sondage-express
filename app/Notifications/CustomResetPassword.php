<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification
{
    use Queueable;

    public string $token;

    /**
     * Crée une nouvelle notification.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Canaux utilisés.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Message envoyé par email.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Réinitialisation de votre mot de passe - Sondage Express')

            ->greeting('Bonjour ' . $notifiable->name . ',')

            ->line('Vous avez demandé la réinitialisation de votre mot de passe sur Sondage Express.')

            ->line('Cliquez sur le bouton ci-dessous pour choisir un nouveau mot de passe.')

            ->action('Réinitialiser mon mot de passe', $url)

            ->line('Ce lien est valable pendant une durée limitée.')

            ->line('Si vous n’êtes pas à l’origine de cette demande, vous pouvez simplement ignorer cet email.')

            ->salutation('À bientôt,')
            ->salutation('L’équipe Sondage Express');
    }
}