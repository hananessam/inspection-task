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
}