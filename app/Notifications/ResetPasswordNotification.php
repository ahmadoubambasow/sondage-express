<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Token de réinitialisation.
     */
    protected string $token;

    /**
     * Créer une nouvelle notification.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Canaux utilisés pour envoyer la notification.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Construire le message email.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Réinitialisation de votre mot de passe - Sondage Express')
            ->view('emails.auth.reset-password', [
                'user' => $notifiable,
                'url' => $url,
            ]);
    }
}