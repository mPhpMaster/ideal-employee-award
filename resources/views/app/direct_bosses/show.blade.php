@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('direct-bosses.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.direct_bosses.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.direct_bosses.inputs.name')</h5>
                    <span>{{ $directBoss->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.direct_bosses.inputs.email')</h5>
                    <span>{{ $directBoss->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.direct_bosses.inputs.employee_number')</h5>
                    <span>{{ $directBoss->employee_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.direct_bosses.inputs.phone')</h5>
                    <span>{{ $directBoss->phone ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.direct_bosses.inputs.position_id')</h5>
                    <span
                        >{{ optional($directBoss->position)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('direct-bosses.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\DirectBoss::class)
                <a
                    href="{{ route('direct-bosses.create') }}"
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
