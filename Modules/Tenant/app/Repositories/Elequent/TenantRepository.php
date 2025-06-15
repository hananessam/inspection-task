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
}