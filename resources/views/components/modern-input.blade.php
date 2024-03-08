<?php $condition = $attr === 'password' || $attr === 'password_confirmation' || $attr === 'cvc'; ?>
<label class="modern-wrapper" style="display: {{ $displayed ?? 'block' }}">
    <input wire:model="{{ $attr }}"
        class="modern-input @if ($errors->has($attr)) modern-input-error @endif"
        type="{{ $condition ? 'password' : 'text' }}" autocomplete="{{ $attr }}" autocorrect="off"
        autocapitalize="off" spellcheck="false" inputmode="{{ $attr }}" name="{{ $attr }}" placeholder=" "
        required>
    <span class="modern-label @if ($errors->has($attr)) modern-label-error @endif">{{ $title }}</span>
    <div class="right-content">
        @if ($condition)
            <button class="password-button" type="button" onclick="passwordListener(event)">
                <i class="eye-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z">
                        </path>
                    </svg>
                </i>
            </button>
        @else
            <button class="reset-button" type="button" onclick="resetListener(event)">
                <i class="reset-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 12 12">
                        <path fill-rule="evenodd"
                            d="M1.707.293A1 1 0 0 0 .293 1.707L4.586 6 .293 10.293a1 1 0 1 0 1.414 1.414L6 7.414l4.293 4.293a1 1 0 0 0 1.414-1.414L7.414 6l4.293-4.293A1 1 0 0 0 10.293.293L6 4.586 1.707.293Z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                </i>
            </button>
        @endif
    </div>
</label>
