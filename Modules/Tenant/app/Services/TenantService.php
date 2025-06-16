<?php

namespace Modules\Tenant\Services;

use Modules\Tenant\Models\Tenant;
use Modules\Tenant\Repositories\Contracts\TenantInterface;

class TenantService
{
    public function __construct(private TenantInterface $tenantInterface)
    {
    }

    /**
     * Get the current tenant.
     *
     * @return \Modules\Tenant\Models\Tenant|null
     */
    public function getCurrent(): ?Tenant
    {
        return $this->tenantInterface->getCurrent();
    }
}