@props(['ratio' => 'h-[400px]', 'class' => ''])
<div {{ $attributes->merge(['class' => 'gk-skel gsk-banner ' . $ratio . ' ' . $class]) }} aria-hidden="true"></div>
