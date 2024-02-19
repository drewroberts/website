<?php

namespace SchulzeFelix\SearchConsole;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use SchulzeFelix\SearchConsole\Exceptions\InvalidConfiguration;

class SearchConsoleServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/search-console.php', 'search-console');

        $searchConsoleConfig = config('search-console');

        $this->app->bind(SearchConsoleClient::class, function () use ($searchConsoleConfig) {
            return SearchConsoleClientFactory::createForConfig($searchConsoleConfig);
        });

        $this->app->bind(SearchConsole::class, function () use ($searchConsoleConfig) {
            $this->guardAgainstInvalidConfiguration($searchConsoleConfig);

            $client = app(SearchConsoleClient::class);

            return new SearchConsole($client);
        });

        $this->app->alias(SearchConsole::class, 'laravel-searchconsole');
    }

    /**
     * @param array|null $searchConsoleConfig
     * @throws InvalidConfiguration
     */
    protected function guardAgainstInvalidConfiguration(array $searchConsoleConfig = null)
    {
        if ($searchConsoleConfig['auth_type'] == 'service_account' && ! file_exists($searchConsoleConfig['connections']['service_account']['application_credentials'])) {
            throw InvalidConfiguration::credentialsJsonDoesNotExist($searchConsoleConfig['connections']['service_account']['application_credentials']);
        }

        if ($searchConsoleConfig['auth_type'] == 'oauth_json' && ! file_exists($searchConsoleConfig['connections']['oauth_json']['auth_config'])) {
            throw InvalidConfiguration::credentialsJsonDoesNotExist($searchConsoleConfig['connections']['oauth_json']['auth_config']);
        }
    }

    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/search-console.php');

        if ($this->app instanceof LaravelApplication) {
            $this->publishes([$source => config_path('search-console.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('search-console');
        }

        $this->mergeConfigFrom($source, 'search-console');
    }
}
