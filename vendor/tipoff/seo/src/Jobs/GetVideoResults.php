<?php

declare(strict_types=1);

namespace Tipoff\Seo\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Tipoff\Seo\Models\Domain;
use Tipoff\Seo\Models\Result;
use Tipoff\Seo\Models\Webpage;

class GetVideoResults implements ShouldQueue
{
    use InteractsWithQueue;
    use Queueable;
    use Dispatchable;

    private $response_data;
    private $ranking_id;
    private $search_locale_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($responseData, $rankingId, $searchLocaleId)
    {
        $this->response_data = $responseData;
        $this->ranking_id = $rankingId;
        $this->search_locale_id = $searchLocaleId;
    }

    public function handle()
    {
        if (isset($this->response_data->inline_videos)) {
            foreach ($this->response_data->inline_videos as $key => $inline_video) {
                $key++; // key starts from zero but position needs to start from one
                $url = $inline_video->link;

                try {
                    $url_array = parseUrl($url);
                } catch (\Exception $e) {
                    echo $e->getMessage()."\n";

                    continue;
                }

                $domain = Domain::firstOrCreate(
                    [
                        'name' => $url_array['name'],
                        'tld' => $url_array['tld'],
                        'https' => $url_array['https'],
                        'subdomain' => $url_array['subdomain'],
                     ],
                    ['created_at' => Carbon::now()->format('Y-m-d H:i:s')]
                );

                $webpage = Webpage::firstOrCreate(
                    [
                        'domain_id' => $domain->id,
                        'path' => Webpage::getUrlPath($inline_video->link),
                        'subdomain' => $url_array['subdomain'],
                    ],
                    ['created_at' => Carbon::now()->format('Y-m-d H:i:s')]
                );

                $result = new Result([
                     'ranking_id' => $this->ranking_id,
                     'type' => 'Inline Video',
                     'position' => $key,
                 ]);
                $result->resultable()->associate($webpage)->save();
            }
        } else {
            throw new \Exception("Didn't get inline video results to parse.");
        }
    }
}
