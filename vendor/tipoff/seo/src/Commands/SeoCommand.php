<?php

namespace Tipoff\Seo\Commands;

use Illuminate\Console\Command;

class SeoCommand extends Command
{
    public $signature = 'seo';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
