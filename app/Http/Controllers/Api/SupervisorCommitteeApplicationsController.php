<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\SupervisorCommittee;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\ApplicationCollection;

class SupervisorCommitteeApplicationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SupervisorCommittee $supervisorCommittee
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        SupervisorCommittee $supervisorCommittee
    ) {
        $this->authorize('view', $supervisorCommittee);

        $search = $request->get('search', '');

        $applications = $supervisorCommittee
            ->applications()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicationCollection($applications);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SupervisorCommittee $supervisorCommittee
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        SupervisorCommittee $supervisorCommittee
    ) {
        $this->authorize('create', Application::class);

        $validated = $request->validate([
            'direct_boss_id' => ['required', 'exists:direct_bosses,id'],
            'employee_id' => ['required', 'exists:employees,id'],
            'technical_committee_id' => [
                'required',
                'exists:technical_committees,id',
            ],
            'award_id' => ['required', 'exists:awards,id'],
            'rank' => ['nullable', 'max:255'],
            'direct_boss_points' => ['nullable', 'max:255'],
            'supervisor_committee_points' => ['nullable', 'max:255'],
            'technical_committee_points' => ['nullable', 'max:255'],
            'employee_points' => ['nullable', 'max:255'],
        ]);

        $application = $supervisorCommittee->applications()->create($validated);

        return new ApplicationResource($application);
    }
}
