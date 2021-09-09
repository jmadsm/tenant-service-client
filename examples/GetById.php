<?php

require_once('_config.php');

use JmaDsm\TenantService\Client;

$client = new Client($config['tenant_service_api_url'], $config['tenant_service_api_token'], false);

$tenant = $client->getById(1);

print_r($tenant);
