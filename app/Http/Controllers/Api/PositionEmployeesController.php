<?php

namespace App\Http\Controllers\Api;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeCollection;

class PositionEmployeesController extends Controller
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

        $employees = $position
            ->employees()
            ->search($search)
            ->latest()
            ->paginate();

        return new EmployeeCollection($employees);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Position $position
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Position $position)
    {
        $this->authorize('create', Employee::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'phone' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'employee_number' => [
                'required',
                'unique:employees,employee_number',
                'max:255',
            ],
            'direct_boss_id' => ['required', 'exists:direct_bosses,id'],
        ]);

        $employee = $position->employees()->create($validated);

        return new EmployeeResource($employee);
    }
}
