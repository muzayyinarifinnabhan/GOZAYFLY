@props(['count' => 1, 'class' => '', 'numberWidth' => '60px', 'labelWidth' => '80%'])
<div {{ $attributes->merge(['class' => 'gsk-stat-item ' . $class]) }} aria-hidden="true">
    @for($i = 0; $i < $count; $i++)
        <div class="gk-skel gsk-stat-number" style="width:{{ $numberWidth }}"></div>
        <div class="gk-skel gsk-line-xs" style="width:{{ $labelWidth }}"></div>
    @endfor
</div>
