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

class GetOrganicResults implements ShouldQueue
{
    use InteractsWithQueue;
    use Queueable;
    use Dispatchable;

    private $response_data;
    private $ranking_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($responseData, $rankingId)
    {
        $this->response_data = $responseData;
        $this->ranking_id = $rankingId;
    }

    public function handle()
    {
        if (isset($this->response_data->organic_results)) {
            foreach ($this->response_data->organic_results as $organic_result) {
                $url = $organic_result->link;

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
                        'path' => Webpage::getUrlPath($organic_result->link),
                        'subdomain' => $url_array['subdomain'],
                    ],
                    ['created_at' => Carbon::now()->format('Y-m-d H:i:s')]
                );

                $result = new Result([
                     'ranking_id' => $this->ranking_id,
                     'type' => 'Organic',
                     'position' => $organic_result->position,
                 ]);
                $result->resultable()->associate($webpage)->save();

                if (isset($organic_result->sitelinks)) {
                    $sitelinks = null;
                    // two types of sitelinks - inline or expanded
                    if (isset($organic_result->sitelinks->inline)) {
                        $sitelinks = $organic_result->sitelinks->inline;
                    } elseif (isset($organic_result->sitelinks->expanded)) {
                        $sitelinks = $organic_result->sitelinks->expanded;
                    }

                    if ($sitelinks != null) {
                        foreach ($sitelinks as $sitelink) {
                            $child_url_array = parseUrl($sitelink->link);
                            $child_webpage = Webpage::firstOrCreate(
                                [
                                     'domain_id' => $domain->id,
                                     'path' => Webpage::getUrlPath($sitelink->link),
                                     'subdomain' => $child_url_array['subdomain'],
                                 ],
                                ['created_at' => Carbon::now()->format('Y-m-d H:i:s')]
                            );

                            $child_result = new Result([
                                 'ranking_id' => $this->ranking_id,
                                 'type' => 'Organic',
                                 'position' => $organic_result->position,
                                 'parent_id' => $result->id,
                             ]);
                            $child_result->resultable()->associate($child_webpage);
                            $child_result->save();
                        }
                    }
                }
            }
        } else {
            throw new \Exception("Didn't get organic results to parse.");
        }
    }
}
