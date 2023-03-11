<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\TechnicalCommittee;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\ApplicationCollection;

class TechnicalCommitteeApplicationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TechnicalCommittee $technicalCommittee
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        TechnicalCommittee $technicalCommittee
    ) {
        $this->authorize('view', $technicalCommittee);

        $search = $request->get('search', '');

        $applications = $technicalCommittee
            ->applications()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicationCollection($applications);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TechnicalCommittee $technicalCommittee
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        TechnicalCommittee $technicalCommittee
    ) {
        $this->authorize('create', Application::class);

        $validated = $request->validate([
            'direct_boss_id' => ['required', 'exists:direct_bosses,id'],
            'employee_id' => ['required', 'exists:employees,id'],
            'supervisor_committee_id' => [
                'required',
                'exists:supervisor_committees,id',
            ],
            'award_id' => ['required', 'exists:awards,id'],
            'rank' => ['nullable', 'max:255'],
            'direct_boss_points' => ['nullable', 'max:255'],
            'supervisor_committee_points' => ['nullable', 'max:255'],
            'technical_committee_points' => ['nullable', 'max:255'],
            'employee_points' => ['nullable', 'max:255'],
        ]);

        $application = $technicalCommittee->applications()->create($validated);

        return new ApplicationResource($application);
    }
}
