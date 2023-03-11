<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\DirectBoss;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.direct_bosses.index',
            compact('directBosses', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', DirectBoss::class);

        $positions = Position::pluck('name', 'id');

        return view('app.direct_bosses.create', compact('positions'));
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

        return redirect()
            ->route('direct-bosses.edit', $directBoss)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DirectBoss $directBoss
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, DirectBoss $directBoss)
    {
        $this->authorize('view', $directBoss);

        return view('app.direct_bosses.show', compact('directBoss'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DirectBoss $directBoss
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, DirectBoss $directBoss)
    {
        $this->authorize('update', $directBoss);

        $positions = Position::pluck('name', 'id');

        return view(
            'app.direct_bosses.edit',
            compact('directBoss', 'positions')
        );
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

        return redirect()
            ->route('direct-bosses.edit', $directBoss)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('direct-bosses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
