<div class="flex w100">
    <label class="modern-wrapper">
        <input wire:model.blur="{{ $key }}"
            class="modern-input @if ($errors->has($key)) modern-input-error @endif" type="text"
            autocomplete="{{ $key }}" autocorrect="off" autocapitalize="off" spellcheck="false"
            inputmode="{{ $key }}" name="{{ $key }}"  placeholder=" " autofocus required>
        <span
            class="modern-label @if ($errors->has($key)) modern-label-error @endif">{{ $title }}</span>
        <div class="right-content">
            <button class="reset-button" type="button" onclick="resetListener(event)">
                <i class="reset-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 12 12">
                        <path fill-rule="evenodd"
                            d="M1.707.293A1 1 0 0 0 .293 1.707L4.586 6 .293 10.293a1 1 0 1 0 1.414 1.414L6 7.414l4.293 4.293a1 1 0 0 0 1.414-1.414L7.414 6l4.293-4.293A1 1 0 0 0 10.293.293L6 4.586 1.707.293Z"
                            clip-rule="evenodd"></path>
                    </svg>
                </i>
            </button>
        </div>
    </label>
    <span class="text-error">
        @error($key)
            {{ $message }}
        @enderror
    </span>
</div>
