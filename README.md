# Laravel: [Naviga](https://www.navigaglobal.com/) API integration

![Packagist License](https://img.shields.io/packagist/l/think.studio/laravel-naviga-ad?color=%234dc71f)
[![Packagist Version](https://img.shields.io/packagist/v/think.studio/laravel-naviga-ad)](https://packagist.org/packages/think.studio/laravel-naviga-ad)
[![Total Downloads](https://img.shields.io/packagist/dt/think.studio/laravel-naviga-ad)](https://packagist.org/packages/think.studio/laravel-naviga-ad)
[![Build Status](https://scrutinizer-ci.com/g/dev-think-one/laravel-naviga-ad/badges/build.png?b=main)](https://scrutinizer-ci.com/g/dev-think-one/laravel-naviga-ad/build-status/main)
[![Code Coverage](https://scrutinizer-ci.com/g/dev-think-one/laravel-naviga-ad/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/dev-think-one/laravel-naviga-ad/?branch=main)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dev-think-one/laravel-naviga-ad/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/dev-think-one/laravel-naviga-ad/?branch=main)

Unofficial web integration with naviga [ad api](docs/API%20Quick%20Reference%20Guide.pdf). <br>
Web reference [there](https://dev.navigahub.com/ElanWebPlatform/devdigital/swagger/ui/index)

## Installation

You can install the package via composer:

```bash
composer require think.studio/laravel-naviga-ad

php artisan vendor:publish --provider="NavigaAdClient\ServiceProvider" --tag="config"
```

```dotenv
NAVIGA_AD_API_USERNAME="api_user"
NAVIGA_AD_API_PASSWORD="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx"
NAVIGA_AD_API_BASE_URL="https://fin.navigahub.com/XxxxxXXXxxxxxx/XXX/api"
```

## Usage

Direct call via facade:

```php
$response = NavigaAd::pendingRequest()->get("campaigns/{$id}");
if ($response->status() == 400) {
   throw new Exception('Campaign deleted');
}
$result = $response->json();
```

Paginated query

```php
/** @var PaginatedResponse $response */
$response = NavigaAd::paginatedRequest('book/ordertypes', perPage: 16, currentPage: 3)->retrieve();
// or
$response = NavigaAd::paginatedRequest('book/orders', 5)->setCurrentPage(2)->retrieve(queryData: [
    'LastModDate' => '2023-07-09T07:14:14.433Z'
]);

$response->entities();
$response->currentPage();
$response->totalPages();
$response->countEntities();
$response->totalEntities();
```

## Credits

- [![Think Studio](https://yaroslawww.github.io/images/sponsors/packages/logo-think-studio.png)](https://think.studio/)
