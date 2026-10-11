@props(['class' => ''])
<div {{ $attributes->merge(['class' => 'gk-skel gsk-hero ' . $class]) }} aria-hidden="true">
    <div class="gk-skel gsk-line-lg" style="width:40%;height:36px;margin-bottom:16px"></div>
    <div class="gk-skel gsk-field" style="width:100%;height:54px;margin-bottom:12px"></div>
    <div class="gk-skel gsk-field" style="width:100%;height:54px;margin-bottom:12px"></div>
    <div class="gk-skel gsk-btn" style="width:100%;height:48px"></div>
</div>
