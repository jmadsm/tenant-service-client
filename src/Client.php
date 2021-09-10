<?php

namespace JmaDsm\TenantService;

use GuzzleHttp\Client as GuzzleClient;

class Client {
    protected $guzzleClient;
    public $tenantId, $token;

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
    public function get(string $token = null): array
    {
        if ($token) $this->token = $token;

        $response = $this->guzzleClient->get('tenants?' . http_build_query(['tenant_token' => $this->token]));

        return json_decode($response->getBody(), true);
    }

    /**
     * Get a tenant application by tenant application id
     *
     * @param   integer $id     tenant application id
     * @return  array   $tenant
     */
    public function getById(int $id = null): array
    {
        if ($id) $this->tenantId = $id;

        $response = $this->guzzleClient->get('tenants?' . http_build_query(['tenant_id' => $this->tenantId]));

        return json_decode($response->getBody(), true);
    }
}
