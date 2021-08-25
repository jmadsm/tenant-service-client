# JMA Tenant Service Client

## Install package
```shell
composer require jmadsm/tenant-service-client
```

## Example
```php
<?php

use JmaDsm\TenantService\Client;

$tenantService = new Client('https://tenantserviceurl.tld', 'api token');

print_r($tenantService->getById(1));
print_r($tenantService->getByApiCompanyId('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx'));
print_r($tenantService->get(['name' => 'example']));
```
