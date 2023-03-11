@php $editing = isset($application) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="direct_boss_id" label="Direct Boss" required>
            @php $selected = old('direct_boss_id', ($editing ? $application->direct_boss_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Direct Boss</option>
            @foreach($directBosses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="employee_id" label="Employee" required>
            @php $selected = old('employee_id', ($editing ? $application->employee_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Employee</option>
            @foreach($employees as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="supervisor_committee_id"
            label="Supervisor Committee"
            required
        >
            @php $selected = old('supervisor_committee_id', ($editing ? $application->supervisor_committee_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Supervisor Committee</option>
            @foreach($supervisorCommittees as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="technical_committee_id"
            label="Technical Committee"
            required
        >
            @php $selected = old('technical_committee_id', ($editing ? $application->technical_committee_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Technical Committee</option>
            @foreach($technicalCommittees as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="award_id" label="Award" required>
            @php $selected = old('award_id', ($editing ? $application->award_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Award</option>
            @foreach($awards as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="rank"
            label="Rank"
            :value="old('rank', ($editing ? $application->rank : '0'))"
            maxlength="255"
            placeholder="Rank"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="direct_boss_points"
            label="Direct Boss Points"
            :value="old('direct_boss_points', ($editing ? $application->direct_boss_points : '0'))"
            maxlength="255"
            placeholder="Direct Boss Points"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="supervisor_committee_points"
            label="Supervisor Committee Points"
            :value="old('supervisor_committee_points', ($editing ? $application->supervisor_committee_points : '0'))"
            maxlength="255"
            placeholder="Supervisor Committee Points"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="technical_committee_points"
            label="Technical Committee Points"
            :value="old('technical_committee_points', ($editing ? $application->technical_committee_points : '0'))"
            maxlength="255"
            placeholder="Technical Committee Points"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="employee_points"
            label="Employee Points"
            :value="old('employee_points', ($editing ? $application->employee_points : '0'))"
            maxlength="255"
            placeholder="Employee Points"
        ></x-inputs.text>
    </x-inputs.group>
</div>
