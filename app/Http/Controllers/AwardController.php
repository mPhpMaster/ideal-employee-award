<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Illuminate\Http\Request;
use App\Http\Requests\AwardStoreRequest;
use App\Http\Requests\AwardUpdateRequest;

class AwardController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Award::class);

        $search = $request->get('search', '');

        $awards = Award::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.awards.index', compact('awards', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Award::class);

        return view('app.awards.create');
    }

    /**
     * @param \App\Http\Requests\AwardStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AwardStoreRequest $request)
    {
        $this->authorize('create', Award::class);

        $validated = $request->validated();

        $award = Award::create($validated);

        return redirect()
            ->route('awards.edit', $award)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Award $award
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Award $award)
    {
        $this->authorize('view', $award);

        return view('app.awards.show', compact('award'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Award $award
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Award $award)
    {
        $this->authorize('update', $award);

        return view('app.awards.edit', compact('award'));
    }

    /**
     * @param \App\Http\Requests\AwardUpdateRequest $request
     * @param \App\Models\Award $award
     * @return \Illuminate\Http\Response
     */
    public function update(AwardUpdateRequest $request, Award $award)
    {
        $this->authorize('update', $award);

        $validated = $request->validated();

        $award->update($validated);

        return redirect()
            ->route('awards.edit', $award)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Award $award
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Award $award)
    {
        $this->authorize('delete', $award);

        $award->delete();

        return redirect()
            ->route('awards.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
