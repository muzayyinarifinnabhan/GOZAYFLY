@props(['fields' => 3, 'class' => '', 'btnText' => 'Cari'])
<div {{ $attributes->merge(['class' => 'gsk-form ' . $class]) }} aria-hidden="true">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-3">
        @for($i = 0; $i < $fields; $i++)
            <div>
                <div class="gk-skel gsk-line gsk-line-xs mb-2" style="width:45%"></div>
                <div class="gk-skel gsk-field" style="width:100%"></div>
            </div>
        @endfor
    </div>
    <div class="gk-skel gsk-btn mt-4" style="height:54px"></div>
</div>
