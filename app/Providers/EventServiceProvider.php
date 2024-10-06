<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Manager\SocialiteWasCalled;
use GuzzleHttp\Client;
use SocialiteProviders\Apple\Provider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'SocialiteProviders\Manager\SocialiteWasCalled' => [
            // add your listeners (aka providers) here
            'SocialiteProviders\Apple\AppleExtendSocialite@handle',
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Socialite::extend('apple', function ($app) {
            $config = $app['config']['services.apple'];
            return SocialiteWasCalled::resolve('SocialiteProviders\\Apple\\Provider')
                ->stateless()
                ->setHttpClient(new Client())
                ->buildProvider(
                    Provider::class,
                    $config
                );
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
