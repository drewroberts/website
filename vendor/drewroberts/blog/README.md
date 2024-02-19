# Laravel package for opinionated blog implementation

[![Latest Version on Packagist](https://img.shields.io/packagist/v/drewroberts/blog.svg?style=flat-square)](https://packagist.org/packages/drewroberts/blog)
![Tests](https://github.com/drewroberts/blog/workflows/Tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/drewroberts/blog.svg?style=flat-square)](https://packagist.org/packages/drewroberts/blog)


Laravel blog package similar to WordPress design with Pages & Posts.

## Installation

You can install the package via composer:

```bash
composer require drewroberts/blog
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="DrewRoberts\Blog\BlogServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Models

We include the following models in this package:

**List of Models**

- Page
- Post
- Series
- Topic

For each of these models, this package implements an [authorization policy](https://laravel.com/docs/8.x/authorization) that extends the roles and permissions approach of the [tipoff/authorization](https://github.com/tipoff/authorization) package. The policies for each model in this package are registered through the package and do not need to be registered manually.

The models also have [Laravel Nova resources](https://nova.laravel.com/docs/3.0/resources/) in this package and they are also registered through the package and do not need to be registered manually.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email packages@drewroberts.com instead of using the issue tracker.

## Credits

- [Drew Roberts](https://github.com/drewroberts)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
