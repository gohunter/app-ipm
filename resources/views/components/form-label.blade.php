@props(['model' => null, 'for' => null, 'required' => false])

<label @if ($for) for="{{ $for }}" @endif>
    {{ $slot }}
    @if ($required === 'true')
    <x-required />
    @endif
</label>
@if ($model)
{{-- @error($model)
<p>{{ $message }}</p>
@enderror --}}
<x-invalid-feedback for="{{ $model }}" />
@endif
