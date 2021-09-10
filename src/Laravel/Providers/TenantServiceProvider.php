<?php

namespace JmaDsm\TenantService\Laravel\Providers;

use JmaDsm\TenantService\Client as TenantServiceClient;

class TenantServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bind TenantServiceClient to container
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/tenant.php' => config_path('tenant.php')
        ], 'tenant-config');

        $this->app->singleton(TenantServiceClient::class, function() {
            return new TenantServiceClient(config('services.tenant-service.endpoint'), config('services.tenant-service.token'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [TenantServiceClient::class];
    }
}
