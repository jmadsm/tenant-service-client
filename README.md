# JMA Tenant Service Client

## Install package
```console
composer require jmadsm/tenant-service-client
```

## Laravel
```console
use Illuminate\Support\Facades\App;
use JmaDsm\TenantService\Client as TenantServiceClient;

php artisan vendor:publish --tag=tag=tenant-config --ansi
```

### Get tenant token with Laravel
```php
$tenantToken = (App::make(TenantServiceClient::class))->token;
```

## Example
See examples directory
