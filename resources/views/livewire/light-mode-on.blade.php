<div id="enlight-mode" class="{{ $checked ? 'light-mode-applied' : '' }}">
    @if ($menu_type === 'top')
        <x-modern-header checked="{{ $checked }}" />
    @elseif($menu_type === 'side')
        <x-modern-side-menu checked="{{ $checked }}" image="{{ base64_encode($image->image_data) }}" />
    @endif
</div>
