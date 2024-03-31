<color-scheme-switcher id="lightModeSwitcher" mode="horizontal">
    <div class="flex h100 w100 h space-btw align">
        <x-svg class="b-img b-img_sun" svg="Sun" />
        <x-svg class="b-img b-img_moon" svg="Moon" />
    </div>
    <input wire:click="toggle" type="checkbox" {{ $checked ? 'checked' : '' }}>
    <div class="toggle-circle"></div>
</color-scheme-switcher>
