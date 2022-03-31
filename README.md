# Laravel: [Naviga](https://www.navigaglobal.com/) API integration

![Packagist License](https://img.shields.io/packagist/l/yaroslawww/laravel-naviga-ad?color=%234dc71f)
[![Packagist Version](https://img.shields.io/packagist/v/yaroslawww/laravel-naviga-ad)](https://packagist.org/packages/yaroslawww/laravel-naviga-ad)
[![Total Downloads](https://img.shields.io/packagist/dt/yaroslawww/laravel-naviga-ad)](https://packagist.org/packages/yaroslawww/laravel-naviga-ad)
[![Build Status](https://scrutinizer-ci.com/g/yaroslawww/laravel-naviga-ad/badges/build.png?b=master)](https://scrutinizer-ci.com/g/yaroslawww/laravel-naviga-ad/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/yaroslawww/laravel-naviga-ad/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/yaroslawww/laravel-naviga-ad/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yaroslawww/laravel-naviga-ad/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yaroslawww/laravel-naviga-ad/?branch=master)

Unofficial web integration with naviga ad api

## Installation

You can install the package via composer:

```bash
composer require yaroslawww/laravel-naviga-ad

php artisan vendor:publish --provider="NavigaAdClient\ServiceProvider" --tag="config"
```

## Usage

Direct call via facade:

```php
$response = NavigaAd::pendingRequest()->get('/api/ad/sizes');
```

or paginated query

```php
/** @var PaginatedResponse $response */
$response = NavigaAd::paginatedRequest('book/ordertypes', 16)->retrieve();
```

## Credits

- [![Think Studio](https://yaroslawww.github.io/images/sponsors/packages/logo-think-studio.png)](https://think.studio/)
