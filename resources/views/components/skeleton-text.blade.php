@props([
    'lines' => 3,
    'class' => '',
    'lineClass' => '',
    'lastWidth' => '40%',
])
<div {{ $attributes->merge(['class' => 'gsk-text ' . $class]) }} aria-hidden="true">
    @for($i = 1; $i <= $lines; $i++)
        <div class="gk-skel gsk-line {{ $lineClass }}"
             style="width: {{ $i === $lines ? $lastWidth : '100%' }};"></div>
    @endfor
</div>