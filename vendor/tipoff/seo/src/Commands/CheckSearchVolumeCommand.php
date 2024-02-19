<?php

declare(strict_types=1);

namespace Tipoff\Seo\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use SchulzeFelix\SearchConsole\Period;
use Tipoff\GoogleApi\Facades\GoogleOauth;
use Tipoff\GoogleApi\GoogleServices;
use Tipoff\Seo\Jobs\CheckKeywordSearchVolumeJob;

class CheckSearchVolumeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'keywords:check-search-volume {url} {--limit=1000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull data from Google Search Console and update keyword search volumes.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get access token from Google Oauth package.
        $accessToken = GoogleOauth::accessToken('google-console');

        /** @var GoogleServices $googleServices */
        $googleServices = app(GoogleServices::class)->setAccessToken($accessToken);

        $batch = Bus::batch([])
            ->name('check-keyword-search-volume-' . date('Y-m-d'))
            ->allowFailures()
            ->onQueue(config('seo.perform_on_queue.check_keyword_search_volume'))
            ->dispatch();

        /**
         * Using SearchConsole Facade directly here,
         * we might need to use registry pattern when we have more provider like Ahrefs or Semrush, etc.
         */
        $googleServices->searchConsole()
            ->setQuotaUser('uniqueQuotaUserString')
            ->searchAnalyticsQuery(
                $this->argument('url'),
                Period::create(now()->subDays(30), now()->subDays(2)),
                ['query'],
                [],
                (int)$this->option('limit'),
                'web',
                'all',
                'auto'
            )
            ->map(fn (array $payload) => $this->createCheckSearchVolumeJob($payload))
            ->chunk(1000)
            ->each(function (Collection $jobs) use ($batch) {
                // Non-arrow function keeps psalm happy for $batch usage
                $batch->add($jobs);
            });
    }

    /**
     * @param array $payload
     * @return CheckKeywordSearchVolumeJob
     */
    private function createCheckSearchVolumeJob(array $payload)
    {
        return new CheckKeywordSearchVolumeJob(
            $payload,
            'google',
            'google-console',
            date('Y-m')
        );
    }
}
