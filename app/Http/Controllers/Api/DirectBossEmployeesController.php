<?php

namespace App\Http\Controllers\Api;

use App\Models\DirectBoss;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeCollection;

class DirectBossEmployeesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DirectBoss $directBoss
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DirectBoss $directBoss)
    {
        $this->authorize('view', $directBoss);

        $search = $request->get('search', '');

        $employees = $directBoss
            ->employees()
            ->search($search)
            ->latest()
            ->paginate();

        return new EmployeeCollection($employees);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DirectBoss $directBoss
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, DirectBoss $directBoss)
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
            'position_id' => ['required', 'exists:positions,id'],
        ]);

        $employee = $directBoss->employees()->create($validated);

        return new EmployeeResource($employee);
    }
}
