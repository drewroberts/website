<?php

declare(strict_types=1);

namespace Tipoff\GoogleApi;

use Google_Client;
use Tipoff\GoogleApi\Contracts\GoogleOauthDriver;
use Tipoff\GoogleApi\Drivers\JsonDriver;
use Tipoff\GoogleApi\Models\GmbAccount;
use Tipoff\GoogleApi\Models\Key;
use Tipoff\GoogleApi\Policies\GmbAccountPolicy;
use Tipoff\GoogleApi\Policies\KeyPolicy;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class GoogleApiServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                Key::class => KeyPolicy::class,
                GmbAccount::class => GmbAccountPolicy::class,
            ])
            ->hasNovaResources([
                \Tipoff\GoogleApi\Nova\Key::class,
                \Tipoff\GoogleApi\Nova\GmbAccount::class,
            ])
            ->hasWebRoute('web')
            ->name('google-api')
            ->hasConfigFile('google-api');
    }

    public function packageRegistered()
    {
        parent::packageRegistered();

        $this->app->singleton(GoogleOauthDriver::class, JsonDriver::class);
    }

    public function bootingPackage()
    {
        parent::bootingPackage();

        $this->app->bind('google-oauth', function ($app) {
            return new GoogleOauth(new Google_Client, $app['config']['google-api']);
        });

        $this->app->bind(GoogleServices::class, function () {
            return new GoogleServices(new Google_Client);
        });
    }
}
