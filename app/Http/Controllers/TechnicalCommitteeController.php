<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TechnicalCommittee;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.technical_committees.index',
            compact('technicalCommittees', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', TechnicalCommittee::class);

        return view('app.technical_committees.create');
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

        return redirect()
            ->route('technical-committees.edit', $technicalCommittee)
            ->withSuccess(__('crud.common.created'));
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

        return view(
            'app.technical_committees.show',
            compact('technicalCommittee')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TechnicalCommittee $technicalCommittee
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Request $request,
        TechnicalCommittee $technicalCommittee
    ) {
        $this->authorize('update', $technicalCommittee);

        return view(
            'app.technical_committees.edit',
            compact('technicalCommittee')
        );
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

        return redirect()
            ->route('technical-committees.edit', $technicalCommittee)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('technical-committees.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
