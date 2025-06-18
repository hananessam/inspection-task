<?php

namespace Modules\Tenant\Services;

use Auth;
use Spatie\Multitenancy\Contracts\IsTenant;
use Spatie\Multitenancy\TenantFinder\TenantFinder as BaseTenantFinder;
use Illuminate\Http\Request;

class UserTenantFinder extends BaseTenantFinder
{
    /**
     * Find the tenant based on the request.
     *
     * @param Request $request
     * @return IsTenant|null
     */
    public function findForRequest(Request $request): ?IsTenant
    {
        $requestUserTenant = Auth::guard('sanctum')->user()?->tenant;

        return $requestUserTenant
            ? app(IsTenant::class)::whereId($requestUserTenant?->id)->first()
            : null;
    }
}