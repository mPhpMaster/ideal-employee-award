@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('employees.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.employees.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.name')</h5>
                    <span>{{ $employee->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.phone')</h5>
                    <span>{{ $employee->phone ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.email')</h5>
                    <span>{{ $employee->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.employee_number')</h5>
                    <span>{{ $employee->employee_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.position_id')</h5>
                    <span
                        >{{ optional($employee->position)->name ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.direct_boss_id')</h5>
                    <span
                        >{{ optional($employee->directBoss)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('employees.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Employee::class)
                <a href="{{ route('employees.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
