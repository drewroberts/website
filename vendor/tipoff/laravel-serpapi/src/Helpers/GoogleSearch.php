<?php

namespace Tipoff\LaravelSerpapi\Helpers;

/* * *
 * Google search
 */

class GoogleSearch extends SerpApiSearch
{
    public function __construct($api_key)
    {
        parent::__construct($api_key, 'google');
    }
}
