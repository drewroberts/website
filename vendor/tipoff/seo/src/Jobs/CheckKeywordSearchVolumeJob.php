<?php

declare(strict_types=1);

namespace Tipoff\Seo\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Tipoff\Seo\Models\Keyword;

class CheckKeywordSearchVolumeJob implements ShouldQueue
{
    use InteractsWithQueue;
    use Queueable;
    use Dispatchable;
    use Batchable;

    private array $payload;
    private string $engine;
    private string $provider;
    private $rangeValue;
    private string $range;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $payload, string $engine, string $provider, $rangeValue, $range = 'month')
    {
        $this->payload = $payload;
        $this->engine = $engine;
        $this->provider = $provider;
        $this->rangeValue = $rangeValue;
        $this->range = $range;
    }

    /**
     * Handle the job.
     *
     * @return void
     */
    public function handle()
    {
        /** @var Keyword $keyword */
        $keyword = Keyword::where('phrase', Arr::get($this->payload, 'query'))->first();

        if (! $keyword) {
            return;
        }

        $keyword->searchVolume()->updateOrCreate(
            [
                'keyword_id' => $keyword->id,
                'engine' => $this->engine,
                'provider' => $this->provider,
            ],
            [
                'range' => $this->range,
                'range_value' => $this->rangeValue,
                'queries' => Arr::get($this->payload, 'impressions'),
                'clicks' => Arr::get($this->payload, 'clicks'),
            ]
        );
    }
}
