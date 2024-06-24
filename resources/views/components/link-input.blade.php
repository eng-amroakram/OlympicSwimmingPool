<label class="form-label"><strong>{{ $label }}</strong></label>
<div class="input-group">
    <span class="input-group-text">
        <i class="fas fa-pen"></i>
    </span>

    <input type="url" wire:model.defer="{{ $name }}" class="form-control"
        placeholder="ادخل {{ $label }}" />

</div>
<div class="form-helper text-danger {{ $name }}-{{ $model }}-validation reset-validation">
</div>
