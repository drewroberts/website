<?php namespace Tipoff\GoogleApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tipoff\GoogleApi\Facades\GoogleOauth;
use Tipoff\GoogleApi\GoogleServices;

class GoogleOauthController extends Controller
{
    public function redirect(Request $request)
    {
        $scopes = $request->get('scopes', app(GoogleServices::class)->scopes());

        return GoogleOauth::setScopes($scopes)->redirect(
            $request->get('identifier'),
            $request->get('home_url')
        );
    }

    public function handleCallback(Request $request)
    {
        GoogleOauth::makeAccessToken();

        $homeUrl = session('google_oauth_home_url', '/');

        $request->session()->forget('google_oauth_home_url');

        return redirect()->to($homeUrl);
    }

    public function logout()
    {
        GoogleOauth::flushAccessToken();

        return redirect()->back();
    }
}
