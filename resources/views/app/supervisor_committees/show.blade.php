@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a
                    href="{{ route('supervisor-committees.index') }}"
                    class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.supervisor_committees.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.supervisor_committees.inputs.name')</h5>
                    <span>{{ $supervisorCommittee->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.supervisor_committees.inputs.email')</h5>
                    <span>{{ $supervisorCommittee->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.supervisor_committees.inputs.employee_number')
                    </h5>
                    <span
                        >{{ $supervisorCommittee->employee_number ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.supervisor_committees.inputs.phone')</h5>
                    <span>{{ $supervisorCommittee->phone ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('supervisor-committees.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\SupervisorCommittee::class)
                <a
                    href="{{ route('supervisor-committees.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
