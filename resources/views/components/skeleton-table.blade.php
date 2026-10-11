@props([
    'rows' => 6,
    'cols' => 5,
    'widths' => null,
    'class' => '',
])
@php
    $ws = $widths ? explode(',', trim($widths)) : [];
@endphp
<div {{ $attributes->merge(['class' => 'gsk-table gk-skel ' . $class]) }} aria-hidden="true">
    <div class="gsk-table-head">
        @for($c = 0; $c < $cols; $c++)
            <div class="gk-skel gsk-th" style="width: {{ $ws[$c] ?? (60 + (($c * 11) % 35)) }}%"></div>
        @endfor
    </div>
    @for($r = 0; $r < $rows; $r++)
        <div class="gsk-tr">
            @for($c = 0; $c < $cols; $c++)
                <div class="gk-skel gsk-td" style="width: {{ $ws[$c] ?? (50 + (($r + $c * 7) % 35)) }}%"></div>
            @endfor
        </div>
    @endfor
</div>