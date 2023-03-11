<?php

namespace App\Http\Controllers\Api;

use App\Models\DirectBoss;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\ApplicationCollection;

class DirectBossApplicationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DirectBoss $directBoss
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DirectBoss $directBoss)
    {
        $this->authorize('view', $directBoss);

        $search = $request->get('search', '');

        $applications = $directBoss
            ->applications()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicationCollection($applications);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DirectBoss $directBoss
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, DirectBoss $directBoss)
    {
        $this->authorize('create', Application::class);

        $validated = $request->validate([
            'employee_id' => ['required', 'exists:employees,id'],
            'supervisor_committee_id' => [
                'required',
                'exists:supervisor_committees,id',
            ],
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

        $application = $directBoss->applications()->create($validated);

        return new ApplicationResource($application);
    }
}
