@props(['class' => '', 'w' => '110px', 'h' => null])
<div {{ $attributes->merge(['class' => 'gk-skel gsk-badge ' . $class]) }}
     @if($h) style="width:{{ $w }};height:{{ $h }}" @else style="width:{{ $w }}" @endif
     aria-hidden="true"></div>