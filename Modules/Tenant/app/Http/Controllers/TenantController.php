<?php

namespace Modules\Tenant\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Tenant\Repositories\Contracts\TenantInterface;
use Modules\Tenant\Transformers\TenantResource;

class TenantController extends Controller
{
    /**
     * TenantController constructor.
     */
    public function __construct(private TenantInterface $tenantRepository)
    {
    }

    /**
     * Get the current tenant.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function currentTenant(Request $request)
    {
        $tenant = $this->tenantRepository->getCurrent();

        if (!$tenant) {
            return response()->json(['message' => __('tenant.not_found')], 404);
        }

        $tenant->load('user');

        return response()->json([
            'tenant' => TenantResource::make($tenant),
        ]);
    }
}
