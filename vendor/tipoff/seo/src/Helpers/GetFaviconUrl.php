<?php

declare(strict_types=1);

if (! function_exists('getFaviconUrl')) {
    /**
     * @param string $domain
     * @param int $size
     * @return string
     */
    function getFaviconUrl(string $domain, int $size = 32): string
    {
        // $domain can be 'example.com' or 'www.example.com'
        $url = 'https://s2.googleusercontent.com/s2/favicons?domain=' . $domain . '&sz=' . $size;
        
        return $url;
    }
}
