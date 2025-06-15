<?php

namespace Modules\Team\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Team\Http\Requests\CreateTeamRequest;
use Modules\Team\Services\TeamService;
use Modules\Team\Transformers\TeamResource;

class TeamController extends Controller
{
    public function __construct(private TeamService $teamService)
    {
    }

    /**
     * Store a new team.
     */
    public function store(CreateTeamRequest $request)
    {
        $team = $this->teamService->create($request->validated());

        return response()->json([
            'message' => __('tenant.team.created'),
            'team' => TeamResource::make($team),
        ], 201);
    }

    /**
     * Get teams by tenant ID.
     */
    public function index(Request $request)
    {
        $teams = $this->teamService->getTeamsByTenantId();

        return response()->json([
            'teams' => TeamResource::collection($teams),
        ]);
    }
}
