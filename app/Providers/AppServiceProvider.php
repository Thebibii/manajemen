<?php

namespace App\Providers;

use App\Models\Event;
use App\Policies\EventPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        //
        Gate::policy(Event::class, EventPolicy::class);

        ResetPassword::toMailUsing(function ($notifiable, string $token) {

            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject(__('notifications.reset_password_subject'))
                ->greeting(__('notifications.greeting'))
                ->line(__('notifications.reset_password_line_1'))
                ->action(__('notifications.reset_password_action'), $url)
                ->line(__('notifications.reset_password_line_2', [
                    'count' => config('auth.passwords.users.expire'),
                ]))
                ->line(__('notifications.reset_password_line_3'))
                ->salutation(__('notifications.salutation'));
        });

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject(__('notifications.verify_email_subject'))
                ->greeting(__('notifications.greeting'))
                ->line(__('notifications.verify_email_line_1'))
                ->action(__('notifications.verify_email_action'), $url)
                ->line(__('notifications.verify_email_line_2'))
                ->salutation(__('notifications.salutation'));
        });
    }
}
