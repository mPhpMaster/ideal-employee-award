@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('awards.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.awards.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.awards.inputs.type')</h5>
                    <span>{{ $award->type ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.awards.inputs.max_employee_points')</h5>
                    <span>{{ $award->max_employee_points ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('awards.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Award::class)
                <a href="{{ route('awards.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
