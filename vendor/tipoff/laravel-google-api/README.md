# Laravel Package for tracking Google laravel-google-api

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tipoff/laravel-google-api.svg?style=flat-square)](https://packagist.org/packages/tipoff/laravel-google-api)
![Tests](https://github.com/tipoff/laravel-google-api/workflows/Tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/tipoff/laravel-google-api.svg?style=flat-square)](https://packagist.org/packages/tipoff/laravel-google-api)

This is where your description should go.

## Installation

You can install the package via composer:

```bash
composer require tipoff/laravel-google-api
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Tipoff\GoogleApi\GoogleApiServiceProvider" --tag="google-api-config"
```

Add the following variables to your `.env` file and set them based on the contents of the
`client_secret.json` file you obtained from Google.
```
GOOGLE_CLIENT_ID=
GOOGLE_PROJECT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URIS=
GOOGLE_JAVASCRIPT_ORIGINS=

GOOGLE_API_KEY=
```

You can use the `|` character to separate multiple strings in the `GOOGLE_REDIRECT_URIS` and `GOOGLE_JAVASCRIPT_ORIGINS` settings.

Obtain an API access token from Google and insert it into the `keys` table, giving it an identifying slug for the next step. (Make sure that the `value` field contains your token formatted as valid JSON.)

Set the value of `GOOGLE_ACCESS_TOKEN_SLUG` in your `.env` file to the name of the slug in your `keys` table entry.

**Note:** If you need to customize the client secret fields or access token value on a service-by-service basis, you may do so by setting values in your `.env` file for the service-specific values found in `config/google-api.php`. (For example, `YOUTUBE_CLIENT_ID`.)

If you do not set service-specific values, it will default to the options set above for each service.

## Models

We include the following models:

**List of Models**

- GMB Account
- Key

For each of these models, this package implements an [authorization policy](https://laravel.com/docs/8.x/authorization) that extends the roles and permissions approach of the [tipoff/authorization](https://github.com/tipoff/authorization) package. The policies for each model in this package are registered through the package and do not need to be registered manually.

The models also have [Laravel Nova resources](https://nova.laravel.com/docs/3.0/resources/) in this package and they are also registered through the package and do not need to be registered manually.


## Usage

```
// Get access token.
$accessToken = GoogleOauth::accessToken('search-console');

// Set access token.
$googleServices = app(GoogleServices::class)->setAccessToken($accessToken);

// Access services.
$searchConsole = $googleServices->searchConsole();
$myBusiness = $googleServices->myBusiness();
$youtube = $googleServices->youtube();
$youtubeAnalytics = $googleServices->youtubeAnalytics();
$analytics = $googleServices->analytics();
$place = $googleServices->places();
```

**Note:** 
- The Google Places service makes use of a third-party wrapper to access the Places API.
Documentation on available methods for it is available [here](https://github.com/SachinAgarwal1337/google-places-api/#available-methods).
- The Google Search Console service makes use of a third-party wrapper to access the Laravel Search Console. Documentation on available methods for it is available [here](https://github.com/schulzefelix/laravel-search-console).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Tipoff](https://github.com/tipoff)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
