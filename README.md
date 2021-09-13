# JMA Tenant Service Client

## Install package
```console
composer require jmadsm/tenant-service-client
```

## Laravel
```console
php artisan vendor:publish --tag=tag=tenant-config --ansi
```

### Get tenant token with Laravel
```php
use Illuminate\Support\Facades\App;
use JmaDsm\TenantService\Client as TenantServiceClient;

$tenantToken = (App::make(TenantServiceClient::class))->token;
```

## Example
See examples directory
