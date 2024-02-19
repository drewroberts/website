<?php

declare(strict_types=1);

namespace Tipoff\Seo\Commands;

use Illuminate\Console\Command;
use Tipoff\Seo\Actions\Keywords\CheckAllKeywordRankings;

class CheckRankingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull:check_rankings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull data with all keywords we have in keywords table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new CheckAllKeywordRankings())();
    }
}
