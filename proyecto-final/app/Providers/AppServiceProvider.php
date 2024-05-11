<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifique su dirección de correo electrónico')
                ->line('Presione el botón a continuación para verificar su dirección de correo electrónico.')
                ->action('Verificar Email', $url)
                ->line('Si no creó una cuenta, no es necesario realizar ninguna acción adicional.');
    });
    }
}
