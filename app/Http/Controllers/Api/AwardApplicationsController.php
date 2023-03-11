<?php

namespace App\Http\Controllers\Api;

use App\Models\Award;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\ApplicationCollection;

class AwardApplicationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Award $award
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Award $award)
    {
        $this->authorize('view', $award);

        $search = $request->get('search', '');

        $applications = $award
            ->applications()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicationCollection($applications);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Award $award
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Award $award)
    {
        $this->authorize('create', Application::class);

        $validated = $request->validate([
            'direct_boss_id' => ['required', 'exists:direct_bosses,id'],
            'employee_id' => ['required', 'exists:employees,id'],
            'supervisor_committee_id' => [
                'required',
                'exists:supervisor_committees,id',
            ],
            'technical_committee_id' => [
                'required',
                'exists:technical_committees,id',
            ],
            'rank' => ['nullable', 'max:255'],
            'direct_boss_points' => ['nullable', 'max:255'],
            'supervisor_committee_points' => ['nullable', 'max:255'],
            'technical_committee_points' => ['nullable', 'max:255'],
            'employee_points' => ['nullable', 'max:255'],
        ]);

        $application = $award->applications()->create($validated);

        return new ApplicationResource($application);
    }
}
