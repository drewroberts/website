# Laravel Package for tracking Google laravel-serpapi

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tipoff/laravel-serpapi.svg?style=flat-square)](https://packagist.org/packages/tipoff/laravel-serpapi)
![Tests](https://github.com/tipoff/laravel-serpapi/workflows/Tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/tipoff/laravel-serpapi.svg?style=flat-square)](https://packagist.org/packages/tipoff/laravel-serpapi)

This is where your description should go.

## Installation

You can install the package via composer:

```bash
composer require tipoff/laravel-serpapi
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Tipoff\LaravelSerpapi\LaravelSerpapiServiceProvider" --tag="laravel-serpapi-config"
```

This is the contents of the published config file:

```php
return [
    'api_key' => env('SERPAPI_API_KEY'),
    'search_engine' => env('SERPAPI_ENGINE', 'google')
];
```

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
