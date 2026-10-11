@props(['class' => '', 'style' => ''])
<div {{ $attributes->merge(['class' => 'gk-skel ' . $class]) }} @if($style) style="{{ $style }}" @endif aria-hidden="true"></div>