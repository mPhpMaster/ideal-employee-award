@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.applications.index_title')
                </h4>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="input-group">
                                <input
                                    id="indexSearch"
                                    type="text"
                                    name="search"
                                    placeholder="{{ __('crud.common.search') }}"
                                    value="{{ $search ?? '' }}"
                                    class="form-control"
                                    autocomplete="off"
                                />
                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        <i class="icon ion-md-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        @can('create', App\Models\Application::class)
                        <a
                            href="{{ route('applications.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.applications.inputs.direct_boss_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.applications.inputs.employee_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.applications.inputs.supervisor_committee_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.applications.inputs.technical_committee_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.applications.inputs.award_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.applications.inputs.rank')
                            </th>
                            <th class="text-left">
                                @lang('crud.applications.inputs.direct_boss_points')
                            </th>
                            <th class="text-left">
                                @lang('crud.applications.inputs.supervisor_committee_points')
                            </th>
                            <th class="text-left">
                                @lang('crud.applications.inputs.technical_committee_points')
                            </th>
                            <th class="text-left">
                                @lang('crud.applications.inputs.employee_points')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $application)
                        <tr>
                            <td>
                                {{ optional($application->directBoss)->name ??
                                '-' }}
                            </td>
                            <td>
                                {{ optional($application->employee)->name ?? '-'
                                }}
                            </td>
                            <td>
                                {{
                                optional($application->supervisorCommittee)->name
                                ?? '-' }}
                            </td>
                            <td>
                                {{
                                optional($application->technicalCommittee)->name
                                ?? '-' }}
                            </td>
                            <td>
                                {{ optional($application->award)->type ?? '-' }}
                            </td>
                            <td>{{ $application->rank ?? '-' }}</td>
                            <td>
                                {{ $application->direct_boss_points ?? '-' }}
                            </td>
                            <td>
                                {{ $application->supervisor_committee_points ??
                                '-' }}
                            </td>
                            <td>
                                {{ $application->technical_committee_points ??
                                '-' }}
                            </td>
                            <td>{{ $application->employee_points ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $application)
                                    <a
                                        href="{{ route('applications.edit', $application) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $application)
                                    <a
                                        href="{{ route('applications.show', $application) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $application)
                                    <form
                                        action="{{ route('applications.destroy', $application) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="11">
                                {!! $applications->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
