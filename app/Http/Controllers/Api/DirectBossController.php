<?php

namespace App\Http\Controllers\Api;

use App\Models\DirectBoss;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\DirectBossResource;
use App\Http\Resources\DirectBossCollection;
use App\Http\Requests\DirectBossStoreRequest;
use App\Http\Requests\DirectBossUpdateRequest;

class DirectBossController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', DirectBoss::class);

        $search = $request->get('search', '');

        $directBosses = DirectBoss::search($search)
            ->latest()
            ->paginate();

        return new DirectBossCollection($directBosses);
    }

    /**
     * @param \App\Http\Requests\DirectBossStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectBossStoreRequest $request)
    {
        $this->authorize('create', DirectBoss::class);

        $validated = $request->validated();

        $directBoss = DirectBoss::create($validated);

        return new DirectBossResource($directBoss);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DirectBoss $directBoss
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, DirectBoss $directBoss)
    {
        $this->authorize('view', $directBoss);

        return new DirectBossResource($directBoss);
    }

    /**
     * @param \App\Http\Requests\DirectBossUpdateRequest $request
     * @param \App\Models\DirectBoss $directBoss
     * @return \Illuminate\Http\Response
     */
    public function update(
        DirectBossUpdateRequest $request,
        DirectBoss $directBoss
    ) {
        $this->authorize('update', $directBoss);

        $validated = $request->validated();

        $directBoss->update($validated);

        return new DirectBossResource($directBoss);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DirectBoss $directBoss
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, DirectBoss $directBoss)
    {
        $this->authorize('delete', $directBoss);

        $directBoss->delete();

        return response()->noContent();
    }
}
