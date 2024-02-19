<?php

namespace Tipoff\LaravelSerpapi\Helpers;

use Tipoff\LaravelSerpapi\Exceptions\SerpApiSearchException;

/* * *
 * Yahoo search
 */

class YahooSearch extends SerpApiSearch
{
    public function __construct($api_key = null)
    {
        parent::__construct($api_key, 'yahoo');
    }

    /*     * *
     * Method is not supported.
     */

    public function get_location($q, $limit)
    {
        throw new SerpApiSearchException("location is not currently supported by Bing");
    }
}
