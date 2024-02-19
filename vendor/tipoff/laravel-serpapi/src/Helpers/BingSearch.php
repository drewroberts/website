<?php

namespace Tipoff\LaravelSerpapi\Helpers;

/* * *
 * Bing search
 */

class BingSearch extends SerpApiSearch
{
    public function __construct($api_key = null)
    {
        parent::__construct($api_key, 'bing');
    }
}
