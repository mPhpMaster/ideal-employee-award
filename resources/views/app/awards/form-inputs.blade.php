@php $editing = isset($award) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="type"
            label="Type"
            :value="old('type', ($editing ? $award->type : ''))"
            maxlength="255"
            placeholder="Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="max_employee_points"
            label="Max Employee Points"
            :value="old('max_employee_points', ($editing ? $award->max_employee_points : '0'))"
            maxlength="255"
            placeholder="Max Employee Points"
        ></x-inputs.text>
    </x-inputs.group>
</div>
