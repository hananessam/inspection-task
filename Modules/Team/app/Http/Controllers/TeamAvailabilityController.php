<?php

namespace Modules\Team\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Team\Http\Requests\CreateTeamAvailabilityRequest;
use Modules\Team\Services\TeamAvailabilityService;
use Modules\Team\Services\TeamService;
use Modules\Tenant\Services\TenantService;
use Modules\Team\Models\Team;
use Illuminate\Http\Request;

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

        if (!$team) {
            return response()->json([
                'message' => __('tenant.team.unauthorized'),
            ], 403);
        }

        $this->teamAvailabilityService->createPluck($request->validated()['availabilities'], $team->id);

        return response()->json([
            'message' => __('tenant.team.availability.created'),
        ], 201);
    }

    /**
     * Generate slots for a team's availability.
     *
     * @param int|string $teamId
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateSlots(Request $request, int|string $teamId)
    {
        $team = $this->getAuthorizedTeam((int) $teamId);

        if (!$team) {
            return response()->json([
                'message' => __('tenant.team.unauthorized'),
            ], 403);
        }

        $slots = $this->teamAvailabilityService->generateSlots(
            $team->id,
            Carbon::parse($request->from),
            Carbon::parse($request->to)
        );

        return response()->json([
            'message' => __('tenant.team.availability.slots'),
            'data' => [
                'slots' => $slots,
            ],
        ], 200);
    }

    /**
     * Helper method to get team and ensure it belongs to current tenant.
     *
     * @param int $teamId
     * @return \Modules\Team\Models\Team|null
     */
    protected function getAuthorizedTeam(int $teamId): Team|null
    {
        $team = $this->teamService->getById($teamId);

        $belongsToTenant = $this->teamService->checkIfTeamBelongsToTenant(
            $team,
            $this->tenantService->getCurrent()?->id
        );

        return $belongsToTenant ? $team : null;
    }
}
