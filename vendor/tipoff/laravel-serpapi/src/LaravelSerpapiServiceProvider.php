<?php

declare(strict_types=1);

namespace Tipoff\LaravelSerpapi;

use Tipoff\LaravelSerpapi\Helpers\SerpApiSearch;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class LaravelSerpapiServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->name('laravel-serpapi')
            ->hasConfigFile('laravel-serpapi'); // If config name is not passed in, `laravel-` is stripped off
    }

    public function register()
    {
        parent::register();

        $this->app->bind(SerpApiSearch::class, function () {
            $api_key = config('laravel-serpapi.api_key');
            $engine = config('laravel-serpapi.search_engine');

            return new SerpApiSearch($api_key, $engine);
        });
    }
}
