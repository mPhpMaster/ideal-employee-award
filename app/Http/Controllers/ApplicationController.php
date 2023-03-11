<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Employee;
use App\Models\DirectBoss;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\TechnicalCommittee;
use App\Models\SupervisorCommittee;
use App\Http\Requests\ApplicationStoreRequest;
use App\Http\Requests\ApplicationUpdateRequest;

class ApplicationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Application::class);

        $search = $request->get('search', '');

        $applications = Application::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.applications.index',
            compact('applications', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Application::class);

        $directBosses = DirectBoss::pluck('name', 'id');
        $employees = Employee::pluck('name', 'id');
        $supervisorCommittees = SupervisorCommittee::pluck('name', 'id');
        $technicalCommittees = TechnicalCommittee::pluck('name', 'id');
        $awards = Award::pluck('type', 'id');

        return view(
            'app.applications.create',
            compact(
                'directBosses',
                'employees',
                'supervisorCommittees',
                'technicalCommittees',
                'awards'
            )
        );
    }

    /**
     * @param \App\Http\Requests\ApplicationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicationStoreRequest $request)
    {
        $this->authorize('create', Application::class);

        $validated = $request->validated();

        $application = Application::create($validated);

        return redirect()
            ->route('applications.edit', $application)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Application $application)
    {
        $this->authorize('view', $application);

        return view('app.applications.show', compact('application'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Application $application)
    {
        $this->authorize('update', $application);

        $directBosses = DirectBoss::pluck('name', 'id');
        $employees = Employee::pluck('name', 'id');
        $supervisorCommittees = SupervisorCommittee::pluck('name', 'id');
        $technicalCommittees = TechnicalCommittee::pluck('name', 'id');
        $awards = Award::pluck('type', 'id');

        return view(
            'app.applications.edit',
            compact(
                'application',
                'directBosses',
                'employees',
                'supervisorCommittees',
                'technicalCommittees',
                'awards'
            )
        );
    }

    /**
     * @param \App\Http\Requests\ApplicationUpdateRequest $request
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function update(
        ApplicationUpdateRequest $request,
        Application $application
    ) {
        $this->authorize('update', $application);

        $validated = $request->validated();

        $application->update($validated);

        return redirect()
            ->route('applications.edit', $application)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Application $application)
    {
        $this->authorize('delete', $application);

        $application->delete();

        return redirect()
            ->route('applications.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
