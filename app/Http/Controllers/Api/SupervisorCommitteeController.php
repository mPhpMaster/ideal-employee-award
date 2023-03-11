<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\SupervisorCommittee;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\SupervisorCommitteeResource;
use App\Http\Resources\SupervisorCommitteeCollection;
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
            ->paginate();

        return new SupervisorCommitteeCollection($supervisorCommittees);
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

        return new SupervisorCommitteeResource($supervisorCommittee);
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

        return new SupervisorCommitteeResource($supervisorCommittee);
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

        return new SupervisorCommitteeResource($supervisorCommittee);
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

        return response()->noContent();
    }
}
