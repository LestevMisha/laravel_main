<div class="form-wrapper">
    <h1>Вход в Клуб Start</h1>

    <form wire:submit="{{ $func }}" class="modern-form">

        <div class="flex w100">
            <label class="modern-wrapper">
                <input wire:model.blur="{{ $key1 }}"
                    class="modern-input @if ($errors->has($key1)) modern-input-error @endif" type="text"
                    autocomplete="{{ $key1 }}" autocorrect="off" autocapitalize="off" spellcheck="false"
                    placeholder=" " inputmode="{{ $key1 }}" name="{{ $key1 }}" autofocus required>
                <span wire:ignore.self class="modern-label @if ($errors->has($key1)) modern-label-error @endif"
                    id="ignoredLabel">{{ $inputTitle1 }}</span>

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
                @error($key1)
                    {{ $message }}
                @enderror
            </span>

            @if ($inputTitle2)
                <label class="modern-wrapper">
                    <input wire:model.blur="{{ $key2 }}"
                        class="modern-input @if ($errors->has($key2)) modern-input-error @endif" type="text"
                        autocomplete="{{ $key2 }}" autocorrect="off" autocapitalize="off" spellcheck="false"
                        placeholder=" " inputmode="{{ $key2 }}" name="{{ $key2 }}" required>
                    <span
                        class="modern-label @if ($errors->has($key2)) modern-label-error @endif">{{ $inputTitle2 }}</span>
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
                @error($key2)
                    <span class="text-error">{{ $message }}</span>
                @enderror
            @endif
        </div>

        <button class="modern-button">
            <i class="modern-next">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M10.707 6.293a1 1 0 0 0-1.414 1.414L13.586 12l-4.293 4.293a1 1 0 1 0 1.414 1.414L15 13.414a2 2 0 0 0 0-2.828l-4.293-4.293Z"
                        clip-rule="evenodd"></path>
                </svg>
            </i>
        </button>
    </form>
    <div id="#hook"></div>
</div>
