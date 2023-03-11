<?php

namespace App\Http\Controllers\Api;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\DirectBossResource;
use App\Http\Resources\DirectBossCollection;

class PositionDirectBossesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Position $position
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Position $position)
    {
        $this->authorize('view', $position);

        $search = $request->get('search', '');

        $directBosses = $position
            ->directBosses()
            ->search($search)
            ->latest()
            ->paginate();

        return new DirectBossCollection($directBosses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Position $position
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Position $position)
    {
        $this->authorize('create', DirectBoss::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:direct_bosses,email', 'email'],
            'employee_number' => [
                'required',
                'unique:direct_bosses,employee_number',
                'max:255',
            ],
            'phone' => ['nullable', 'max:255', 'string'],
        ]);

        $directBoss = $position->directBosses()->create($validated);

        return new DirectBossResource($directBoss);
    }
}
