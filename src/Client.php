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
     * Search for a tenant by tenant parametes
     *
     * @param array $searchParams   Allowed search parameters are:
     * [
     *   'id', 'name', 'subdomain', 'cname_domain', 'api_company_id'
     *   'api_base_url', 'api_user', 'api_tenant', 'api_rest_version'
     * ]
     * @return array                Array of tenants
     */
    public function get(array $searchParams = [])
    {
        $response = $this->guzzleClient->get('api/tenant?' . http_build_query($searchParams));

        return json_decode($response->getBody(), true)['data'] ?? [];
    }

    /**
     * Get tenant data by id
     *
     * @param integer $id
     * @return array        Tenant array
     */
    public function getById(int $id): array
    {
        $tenant = $this->get(['id' => $id]);

        return count($tenant) === 1 ? $tenant[0] : null;
    }

    /**
     * Get tenant data by api company id
     *
     * @param string $apiCompanyId
     * @return array                Tenant array
     */
    public function getByApiCompanyId(string $apiCompanyId): array
    {
        $tenant = $this->get(['api_company_id' => $apiCompanyId]);

        return count($tenant) === 1 ? $tenant[0] : null;
    }
}
