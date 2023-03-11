<?php

namespace App\Http\Controllers\Api;

use App\Models\Award;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\AwardResource;
use App\Http\Resources\AwardCollection;
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
            ->paginate();

        return new AwardCollection($awards);
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

        return new AwardResource($award);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Award $award
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Award $award)
    {
        $this->authorize('view', $award);

        return new AwardResource($award);
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

        return new AwardResource($award);
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

        return response()->noContent();
    }
}
