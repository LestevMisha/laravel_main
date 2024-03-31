<label class="modern-wrapper" style="display: {{ $displayed ?? 'block' }}">
    <input wire:model="{{ $attr }}"
        class="modern-input date @if ($errors->has($attr)) modern-input-error @endif" type="text"
        autocomplete="{{ $attr }}" autocorrect="off" autocapitalize="off" spellcheck="false"
        inputmode="{{ $attr }}" name="{{ $attr }}" placeholder=" " maxlength="7" required>
    <span class="modern-label @if ($errors->has($attr)) modern-label-error @endif">{{ $title }}</span>
    <div class="right-content">
        <button class="reset-button" type="button" onclick="resetListener(event)">
            <x-svg class="reset-icon" svg="Cross" />
        </button>
    </div>
</label>
