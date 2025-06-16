<?php

namespace Modules\Team\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Team\Enums\DayOfWeekEnum;
use Modules\Team\Http\Requests\CreateTeamAvailabilityRequest;
use Modules\Team\Services\TeamAvailabilityService;
use Modules\Team\Services\TeamService;
use Modules\Tenant\Services\TenantService;

class TeamAvailabilityController extends Controller
{
    public function __construct(private TeamAvailabilityService $teamAvailabilityService, private TeamService $teamService, private TenantService $tenantService)
    {
    }

    /**
     * Store a new team's availability.
     * 
     * @param CreateTeamAvailabilityRequest $request
     * @param int|string $teamId
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeAvailabilities(CreateTeamAvailabilityRequest $request, int|string $teamId)
    {
        $team = $this->teamService->getById((int) $teamId);

        // Validate that the team exists.
        if (!$team) {
            return response()->json([
                'message' => __('team.team.not_found'),
            ], 422);
        }

        // Validate that the team belongs to the current tenant.
        if ($team->tenant_id !== $this->tenantService->getCurrent()?->id) {
            return response()->json([
                'message' => __('team.team.not_belongs_to_current_tenant'),
            ], 403);
        }

        $this->teamAvailabilityService->createPluck($request->validated()['availabilities'], (int) $teamId);

        return response()->json([
            'message' => __('tenant.team.availability.created'),
        ], 201);
    }
}
