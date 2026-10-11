@props(['count' => 4, 'class' => ''])
<div {{ $attributes->merge(['class' => 'gsk-list gk-skel ' . $class]) }} aria-hidden="true">
    @for($i = 0; $i < $count; $i++)
        <div class="gsk-list-item">
            <x-skeleton-circle size="w-11 h-11" />
            <x-skeleton-text :lines="2" class="gsk-list-lines" />
        </div>
    @endfor
</div>