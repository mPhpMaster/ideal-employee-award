<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Requests\PositionStoreRequest;
use App\Http\Requests\PositionUpdateRequest;

class PositionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Position::class);

        $search = $request->get('search', '');

        $positions = Position::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.positions.index', compact('positions', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Position::class);

        return view('app.positions.create');
    }

    /**
     * @param \App\Http\Requests\PositionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionStoreRequest $request)
    {
        $this->authorize('create', Position::class);

        $validated = $request->validated();

        $position = Position::create($validated);

        return redirect()
            ->route('positions.edit', $position)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Position $position
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Position $position)
    {
        $this->authorize('view', $position);

        return view('app.positions.show', compact('position'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Position $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Position $position)
    {
        $this->authorize('update', $position);

        return view('app.positions.edit', compact('position'));
    }

    /**
     * @param \App\Http\Requests\PositionUpdateRequest $request
     * @param \App\Models\Position $position
     * @return \Illuminate\Http\Response
     */
    public function update(PositionUpdateRequest $request, Position $position)
    {
        $this->authorize('update', $position);

        $validated = $request->validated();

        $position->update($validated);

        return redirect()
            ->route('positions.edit', $position)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Position $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Position $position)
    {
        $this->authorize('delete', $position);

        $position->delete();

        return redirect()
            ->route('positions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
