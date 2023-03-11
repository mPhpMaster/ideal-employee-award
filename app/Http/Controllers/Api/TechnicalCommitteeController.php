<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\TechnicalCommittee;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\TechnicalCommitteeResource;
use App\Http\Resources\TechnicalCommitteeCollection;
use App\Http\Requests\TechnicalCommitteeStoreRequest;
use App\Http\Requests\TechnicalCommitteeUpdateRequest;

class TechnicalCommitteeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', TechnicalCommittee::class);

        $search = $request->get('search', '');

        $technicalCommittees = TechnicalCommittee::search($search)
            ->latest()
            ->paginate();

        return new TechnicalCommitteeCollection($technicalCommittees);
    }

    /**
     * @param \App\Http\Requests\TechnicalCommitteeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TechnicalCommitteeStoreRequest $request)
    {
        $this->authorize('create', TechnicalCommittee::class);

        $validated = $request->validated();

        $technicalCommittee = TechnicalCommittee::create($validated);

        return new TechnicalCommitteeResource($technicalCommittee);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TechnicalCommittee $technicalCommittee
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        TechnicalCommittee $technicalCommittee
    ) {
        $this->authorize('view', $technicalCommittee);

        return new TechnicalCommitteeResource($technicalCommittee);
    }

    /**
     * @param \App\Http\Requests\TechnicalCommitteeUpdateRequest $request
     * @param \App\Models\TechnicalCommittee $technicalCommittee
     * @return \Illuminate\Http\Response
     */
    public function update(
        TechnicalCommitteeUpdateRequest $request,
        TechnicalCommittee $technicalCommittee
    ) {
        $this->authorize('update', $technicalCommittee);

        $validated = $request->validated();

        $technicalCommittee->update($validated);

        return new TechnicalCommitteeResource($technicalCommittee);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TechnicalCommittee $technicalCommittee
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        TechnicalCommittee $technicalCommittee
    ) {
        $this->authorize('delete', $technicalCommittee);

        $technicalCommittee->delete();

        return response()->noContent();
    }
}
