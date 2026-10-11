@props(['ratio' => 'aspect-[4/3]', 'class' => ''])
<div {{ $attributes->merge(['class' => 'gk-skel gsk-image ' . $ratio . ' ' . $class]) }} aria-hidden="true"></div>