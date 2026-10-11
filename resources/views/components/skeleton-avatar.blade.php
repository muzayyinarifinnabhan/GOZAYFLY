@props(['size' => 'w-12 h-12', 'class' => ''])
<div {{ $attributes->merge(['class' => 'gk-skel gsk-avatar ' . $size . ' ' . $class]) }} aria-hidden="true"></div>
