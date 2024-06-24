<label class="form-label" for="forAddingDate"><strong>{{ $label }}</strong></label>
<div class="form-outline datepicker {{ $control }}" data-mdb-inline="true" data-mdb-format="yyyy-mm-dd">
    <input type="text" class="form-control" data-mdb-format="yyyy-mm-dd" wire:model.defer="{{ $name }}"
        placeholder="yyyy-mm-dd">
</div>

<div class="form-helper text-danger {{ $name }}-{{ $model }}-validation reset-validation">
</div>
