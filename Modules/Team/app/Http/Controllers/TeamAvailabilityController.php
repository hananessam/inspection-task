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
        $team = $this->getAuthorizedTeam((int) $teamId);

        $this->teamAvailabilityService->createPluck($request->validated()['availabilities'], $team->id);

        return response()->json([
            'message' => __('tenant.team.availability.created'),
        ], 201);
    }

    /**
     * Helper method to get team and ensure it belongs to current tenant.
     */
    protected function getAuthorizedTeam(int $teamId)
    {
        $team = $this->teamService->getById($teamId);

        $this->teamService->checkIfTeamBelongsToTenant(
            $team,
            $this->tenantService->getCurrent()?->id
        );

        return $team;
    }
}
