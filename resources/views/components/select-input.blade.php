<label class="form-label"><strong>{{ $label }}</strong></label>
<select class="select" id="{{ $id }}" wire:model.live="{{ $name }}" data-mdb-filter="true"
    data-mdb-container="{{ $modelid }}">
    @foreach ($options as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
</select>
<div class="form-helper text-danger {{ $name }}-{{ $model }}-validation reset-validation">
</div>
