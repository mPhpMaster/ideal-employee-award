<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupervisorCommittee;
use App\Http\Requests\SupervisorCommitteeStoreRequest;
use App\Http\Requests\SupervisorCommitteeUpdateRequest;

class SupervisorCommitteeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', SupervisorCommittee::class);

        $search = $request->get('search', '');

        $supervisorCommittees = SupervisorCommittee::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.supervisor_committees.index',
            compact('supervisorCommittees', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', SupervisorCommittee::class);

        return view('app.supervisor_committees.create');
    }

    /**
     * @param \App\Http\Requests\SupervisorCommitteeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupervisorCommitteeStoreRequest $request)
    {
        $this->authorize('create', SupervisorCommittee::class);

        $validated = $request->validated();

        $supervisorCommittee = SupervisorCommittee::create($validated);

        return redirect()
            ->route('supervisor-committees.edit', $supervisorCommittee)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SupervisorCommittee $supervisorCommittee
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        SupervisorCommittee $supervisorCommittee
    ) {
        $this->authorize('view', $supervisorCommittee);

        return view(
            'app.supervisor_committees.show',
            compact('supervisorCommittee')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SupervisorCommittee $supervisorCommittee
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Request $request,
        SupervisorCommittee $supervisorCommittee
    ) {
        $this->authorize('update', $supervisorCommittee);

        return view(
            'app.supervisor_committees.edit',
            compact('supervisorCommittee')
        );
    }

    /**
     * @param \App\Http\Requests\SupervisorCommitteeUpdateRequest $request
     * @param \App\Models\SupervisorCommittee $supervisorCommittee
     * @return \Illuminate\Http\Response
     */
    public function update(
        SupervisorCommitteeUpdateRequest $request,
        SupervisorCommittee $supervisorCommittee
    ) {
        $this->authorize('update', $supervisorCommittee);

        $validated = $request->validated();

        $supervisorCommittee->update($validated);

        return redirect()
            ->route('supervisor-committees.edit', $supervisorCommittee)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SupervisorCommittee $supervisorCommittee
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        SupervisorCommittee $supervisorCommittee
    ) {
        $this->authorize('delete', $supervisorCommittee);

        $supervisorCommittee->delete();

        return redirect()
            ->route('supervisor-committees.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
