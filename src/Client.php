<?php

namespace JmaDsm\TenantService;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    protected $guzzleClient;
    public $tenantId;
    public $token;
    public $domain;

    /**
     * Array of last received tenant
     *
     * @var array
     */
    public array $lastReceivedTenant;

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
            'headers'  => [
                'Authorization' => 'Bearer ' . $apiToken
            ]
        ]);
    }

    /**
     * Get a tenant application by tenant application token
     *
     * @param  string $token tenant application token
     * @return array  $tenant
     */
    public function get(string $token = null)
    {
        if ($token) {
            $this->token = $token;
        }

        try {
            $response = $this->guzzleClient->get('tenants?' . http_build_query(['tenant_token' => $this->token]));
        } catch (\GuzzleHttp\Exception\ClientException $th) {
            if ($th->getResponse()->getStatusCode() === 404) {
                return null;
            } else {
                throw $th;
            }
        }

        $tenant                   = json_decode($response->getBody(), true);
        $this->lastReceivedTenant = $tenant;

        return $tenant;
    }

    /**
     * Get a tenant application by tenant application id
     *
     * @param  integer $id tenant application id
     * @return array   $tenant
     */
    public function getById(int $id = null): array|null
    {
        if ($id) {
            $this->tenantId = $id;
        }

        try {
            $response = $this->guzzleClient->get('tenants?' . http_build_query(['tenant_id' => $this->tenantId]));
        } catch (\GuzzleHttp\Exception\ClientException $th) {
            if ($th->getResponse()->getStatusCode() === 404) {
                return null;
            } else {
                throw $th;
            }
        }

        $tenant                   = json_decode($response->getBody(), true);
        $this->lastReceivedTenant = $tenant;

        return $tenant;
    }

    /**
     * Get a tenant application by tenant application id
     *
     * @param  integer $id tenant application id
     * @return array   $tenant
     */
    public function getByDomain(string $domain = null): array|null
    {
        if ($domain) {
            $this->domain = $domain;
        }

        try {
            $response = $this->guzzleClient->get('tenants?' . http_build_query(['tenant_domain' => $this->domain]));
        } catch (\GuzzleHttp\Exception\ClientException $th) {
            if ($th->getResponse()->getStatusCode() === 404) {
                return null;
            } else {
                throw $th;
            }
        }

        $tenant                   = json_decode($response->getBody(), true);
        $this->lastReceivedTenant = $tenant;

        return $tenant;
    }

    /**
     * Get a list of tenant applications
     *
     * @param  string $searchKeyWord Any key in the Tenant table
     * @param  string $searchWord    The phrase to search for
     * @return array  $tenant
     */
    public function search(string $searchKeyWord = null, string $searchWord = null): array
    {
        $query    = $searchKeyWord ? 'search?' . http_build_query([$searchKeyWord => (string) $searchWord]) : 'search';
        $response = $this->guzzleClient->get($query);

        return json_decode($response->getBody(), true);
    }
}
