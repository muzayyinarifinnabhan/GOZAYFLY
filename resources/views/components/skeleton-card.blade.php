@props([
    'image' => true,
    'ratio' => 'h-48 w-full',
    'lines' => 3,
    'footer' => false,
    'class' => '',
])
<div {{ $attributes->merge(['class' => 'gsk-card gk-skel ' . $class]) }} aria-hidden="true">
    @if ($image)
        <div class="gk-skel gsk-image {{ $ratio }}"></div>
    @endif
    <div class="gsk-card-body">
        <x-skeleton-text :lines="$lines" />
        @if ($footer)
            <div class="gsk-card-footer">
                <div class="gk-skel gsk-line gsk-line-sm" style="width:55%"></div>
                <div class="gk-skel gsk-btn" style="width:38%;height:40px"></div>
            </div>
        @endif
    </div>
</div>