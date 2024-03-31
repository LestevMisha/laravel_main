<?php $condition = $attr === 'password' || $attr === 'password_confirmation' || $attr === 'cvc'; ?>
<label class="modern-wrapper" style="display: {{ $displayed ?? 'block' }}">
    <input wire:model="{{ $attr }}"
        class="modern-input @if ($errors->has($attr)) modern-input-error @endif"
        type="{{ $condition ? 'password' : 'text' }}" autocomplete="{{ $attr }}" autocorrect="off"
        autocapitalize="off" spellcheck="false" inputmode="{{ $attr }}" name="{{ $attr }}" placeholder=" "
        required>
    <span class="modern-label @if ($errors->has($attr)) modern-label-error @endif">{{ $title }}</span>
    <div wire:ignore class="right-content">
        @if ($condition)
            <button class="password-button" type="button" onclick="passwordListener(event)">
                <x-svg class="eye-icon" svg="Eye" />
            </button>
        @else
            <button class="reset-button" type="button" onclick="resetListener(event)">
                <x-svg class="reset-icon" svg="Cross" />
            </button>
        @endif
    </div>
</label>
