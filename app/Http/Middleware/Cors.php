<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// https://stackoverflow.com/questions/47619079/making-an-xhr-request-from-amp-html-contact-form-to-laravel-5-4-500-error

// https://stackoverflow.com/questions/39429462/adding-access-control-allow-origin-header-response-in-laravel-5-3-passport

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $origin = request()->__amp_source_origin;
        if (is_null($origin)) {
            $origin = '*';
        }

        return $next($request)
        ->header('Access-Control-Allow-Credentials', 'true')
        ->header('Access-Control-Allow-Origin', $origin)
        ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, Content-Length, Accept-Encoding, X-CSRF-Token')
        ->header('Access-Control-Expose-Headers', 'AMP-Access-Control-Allow-Source-Origin, AMP-Redirect-To')
        ->header('AMP-Access-Control-Allow-Source-Origin', $origin);
    }
}
