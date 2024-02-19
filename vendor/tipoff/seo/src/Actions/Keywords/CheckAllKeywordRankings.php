<?php

declare(strict_types=1);

namespace Tipoff\Seo\Actions\Keywords;

use Tipoff\Seo\Models\Keyword;

class CheckAllKeywordRankings
{
    public function __invoke(): void
    {
        $keywords = Keyword::all(); // gets only currently active keywords

        foreach ($keywords as $keyword) {
            $keyword->getRanking();
        }
    }
}
