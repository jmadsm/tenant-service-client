<?php

namespace JmaDsm\TenantService;

use GuzzleHttp\Client as GuzzleClient;

class Client {
    protected $guzzleClient;

    /**
     * Constructs a new TenantServiceClient
     *
     * @param string $endpoint
     * @param string $apiToken
     */
    public function __construct(string $endpoint, string $apiToken)
    {
        $this->guzzleClient = new GuzzleClient([
            'base_uri' => $endpoint,
            'headers' => [
                'Authorization' => 'Bearer ' . $apiToken
            ]
        ]);
    }

    /**
     * Get a tenant application by tenant application token
     *
     * @param   string  $token  tenant application token
     * @return  array   $tenant
     */
    public function get(string $token): array
    {
        $response = $this->guzzleClient->get('tenants?' . http_build_query(['tenant_token' => $token]));

        return json_decode($response->getBody(), true);
    }

    /**
     * Get a tenant application by tenant application id
     *
     * @param   integer $id     tenant application id
     * @return  array   $tenant
     */
    public function getById(int $id): array
    {
        $response = $this->guzzleClient->get('tenants?' . http_build_query(['tenant_id' => $id]));

        return json_decode($response->getBody(), true);
    }
}
