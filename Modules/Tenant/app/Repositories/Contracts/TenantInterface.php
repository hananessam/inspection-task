<?php

namespace Modules\Tenant\Repositories\Contracts;

use Modules\Tenant\Models\Tenant;

interface TenantInterface
{
    /**
     * Register a new Tenant.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): Tenant;

    /**
     * Forget the current tenant.
     *
     * @return void
     */
    public function forgetCurrent(): void;

    /**
     * Set the current tenant.
     *
     * @param Tenant $tenant
     * @return void
     */
    public function setCurrent(Tenant $tenant): void;
}