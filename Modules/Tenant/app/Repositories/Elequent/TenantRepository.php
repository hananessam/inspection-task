<?php

namespace Modules\Tenant\Repositories\Elequent;

use Modules\Tenant\Models\Tenant;
use Modules\Tenant\Repositories\Contracts\TenantInterface;

class TenantRepository implements TenantInterface
{
    /**
     * Register a new Tenant.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): Tenant
    {
        return Tenant::create($data);
    }

    /**
     * Forget the current tenant.
     * @return void
     */
    public function forgetCurrent(): void
    {
        Tenant::forgetCurrent();
    }

    /**
     * Set the current tenant.
     *
     * @param Tenant $tenant
     * @return void
     */
    public function setCurrent(Tenant $tenant): void
    {
        $tenant->makeCurrent();
    }

    /**
     * Get the current tenant.
     *
     * @return Tenant|null
     */
    public function getCurrent(): ?Tenant
    {
        return Tenant::current();
    }
}