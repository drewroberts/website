<?php

declare(strict_types=1);

if (! function_exists('parseUrl')) {
    /**
     * Explode unformatted url
     *
     * @param string $url
     * @return array
     * @throws Exception
     */
    function parseUrl(string $url): array
    {
        $https = true;
        $subdomain = '';

        $pieces = parse_url($url);

        // host e.g. 'www.example.com'
        $host = $pieces['host'];
        $hostPieces = explode('.', $host);

        // length 4 will not work, e.g. www.some.example.com
        if (count($hostPieces) === 1) {
            throw new Exception('Hostname only 1 part.  e.g. (3 parts) www.example.com');
        } elseif (count($hostPieces) === 2) {
            // $subdomain is an empty string
            $name = $hostPieces[0];
            $tld = $hostPieces[1];
        } elseif (count($hostPieces) === 3) {
            $subdomain = $hostPieces[0];
            $name = $hostPieces[1];
            $tld = $hostPieces[2];
        } else {
            throw new Exception('Hostname more than 3 parts.  e.g. (4 parts) www.another.example.com');
        }

        if ($pieces['scheme'] !== 'https') {
            $https = false;
        }

        return [
            'https' => $https,
            'subdomain' => $subdomain,
            'name' => $name,
            'tld' => $tld,
        ];
    }
}
