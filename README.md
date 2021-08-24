# JMA Tenant Service Client

## Install package
In your ```composer.json``` add this repository.
Example ```composer.json```
```json
{
    "name": "test/test",
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/jmadsm/tenant-service-client"
        }
    ],
    "require": {
        ...
    }
    ...
}
```

Once the repository has been added, you can install the package by running:
```shell
composer require jmadsm/tenant-service-client:dev-main
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
