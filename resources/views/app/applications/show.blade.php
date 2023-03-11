@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('applications.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.applications.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.applications.inputs.direct_boss_id')</h5>
                    <span
                        >{{ optional($application->directBoss)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.applications.inputs.employee_id')</h5>
                    <span
                        >{{ optional($application->employee)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.applications.inputs.supervisor_committee_id')
                    </h5>
                    <span
                        >{{ optional($application->supervisorCommittee)->name ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.applications.inputs.technical_committee_id')
                    </h5>
                    <span
                        >{{ optional($application->technicalCommittee)->name ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.applications.inputs.award_id')</h5>
                    <span
                        >{{ optional($application->award)->type ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.applications.inputs.rank')</h5>
                    <span>{{ $application->rank ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.applications.inputs.direct_boss_points')
                    </h5>
                    <span>{{ $application->direct_boss_points ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.applications.inputs.supervisor_committee_points')
                    </h5>
                    <span
                        >{{ $application->supervisor_committee_points ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.applications.inputs.technical_committee_points')
                    </h5>
                    <span
                        >{{ $application->technical_committee_points ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.applications.inputs.employee_points')</h5>
                    <span>{{ $application->employee_points ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('applications.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Application::class)
                <a
                    href="{{ route('applications.create') }}"
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
