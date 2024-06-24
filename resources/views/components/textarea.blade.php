<label class="form-label select-label mb-1"><strong>{{ $label }}</strong></label>
<div class="input-group">
    <textarea wire:model.defer="{{ $name }}" maxlength="500" class="form-control" style="height: 100px;">
</textarea>
</div>

<div class="form-helper text-danger {{ $name }}-{{ $model }}-validation reset-validation">
</div>
