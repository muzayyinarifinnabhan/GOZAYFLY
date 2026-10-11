<!-- ============================================================
      GoZay Skeleton Loading (overlay halaman + shimmer gambar)
      Dipakai bersama oleh seluruh layout
      ============================================================ -->
<style>
    /* ============================
       CSS VARIABLES - Skeleton Theme
       Sesuaikan dengan tema website GoZay
       ============================ */
    :root {
        --skeleton-base: #ece9e6;
        --skeleton-base-light: #f7f5f2;
        --skeleton-highlight: #f0ede9;
        --skeleton-shimmer-start: rgba(255,255,255,0);
        --skeleton-shimmer-mid: rgba(240,237,233,0.6);
        --skeleton-shimmer-end: rgba(255,255,255,0);
        --skeleton-card-bg: #ffffff;
        --skeleton-card-border: rgba(12,12,12,0.06);
        --skeleton-text-primary: #1c1b1b;
        --skeleton-text-secondary: #434652;
        --skeleton-border: rgba(12,12,12,0.05);
        --skeleton-radius: 16px;
        --skeleton-shimmer-duration: 1.8s;
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        :root {
            --skeleton-base: #2a2a2a;
            --skeleton-base-light: #333333;
            --skeleton-highlight: #3a3a3a;
            --skeleton-shimmer-mid: rgba(255,255,255,0.06);
            --skeleton-card-bg: #1e1e1e;
            --skeleton-card-border: rgba(255,255,255,0.06);
            --skeleton-text-primary: #f3f0ef;
            --skeleton-text-secondary: #aaaeb3;
        }
    }

    /* ============================
       SHIMMER EFFECT - Core Animation
       ============================ */
    .gk-skel {
        position: relative;
        overflow: hidden;
        background: var(--skeleton-base);
        background-image: linear-gradient(
            90deg,
            var(--skeleton-base) 25%,
            var(--skeleton-highlight) 50%,
            var(--skeleton-base) 75%
        );
        background-size: 200% 100%;
        animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite;
    }

    @keyframes gk-shimmer {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: -200% 0;
        }
    }

    /* Enhanced shimmer with pseudo-element for extra shine */
    .gk-skel::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
            90deg,
            transparent 0%,
            rgba(255,255,255,0.15) 50%,
            transparent 100%
        );
        background-size: 200% 100%;
        animation: gk-shimmer-shine 2.2s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes gk-shimmer-shine {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: -200% 0;
        }
    }

    /* ============================
       IMAGE SKELETON
       ============================ */
    img.gk-skel {
        border-radius: inherit;
        visibility: hidden;
    }
    img.gk-skel.gk-loaded {
        visibility: visible;
    }

    /* Background image skeleton */
    [data-gk-bg].gk-skel {
        position: relative;
    }
    [data-gk-bg].gk-skel::before {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--skeleton-base);
        z-index: 0;
    }

    /* ============================
       PAGE OVERLAY SKELETON
       ============================ */
    .gk-overlay {
        position: fixed;
        inset: 0;
        z-index: 2147483000;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #FAF9F7;
        opacity: 0;
        visibility: hidden;
        transition: opacity .55s ease, visibility 0s .55s;
    }
    body.gk-booting .gk-overlay {
        opacity: 1;
        visibility: visible;
        transition: opacity .2s ease, visibility 0s 0s;
    }
    body.gk-booting .gk-overlay.gk-gone {
        opacity: 0;
        visibility: hidden;
    }
    .gk-overlay-inner {
        width: min(520px, 86vw);
        display: flex;
        flex-direction: column;
        gap: 26px;
    }
    .gk-overlay-logo {
        width: 64px;
        height: 64px;
        margin: 0 auto;
        border-radius: 18px;
    }
    .gk-overlay-planewrap {
        display: flex;
        justify-content: center;
    }
    .gk-overlay-plane {
        width: 52px;
        height: 52px;
        border-radius: 16px;
    }
    .gk-overlay-bars {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .gk-overlay-bar {
        height: 14px;
        border-radius: 999px;
    }
    .gk-overlay-bar.w40 { width: 40%; }
    .gk-overlay-bar.w70 { width: 70%; }
    .gk-overlay-bar.w90 { width: 90%; }
    .gk-overlay-bar.w100 { width: 100%; }

    /* ============================
       LAYOUT MATCHING ZONES
       ============================ */
    [data-sk-zone] { position: relative; }
    [data-sk-content] { opacity: 0; visibility: hidden; transition: opacity .45s ease, visibility 0s .45s; }
    [data-sk-skeleton] { position: absolute; inset: 0; z-index: 3; opacity: 1; visibility: visible; pointer-events: none; transition: opacity .45s ease, visibility 0s 0s; }
    body.gsk-ready [data-sk-content] { opacity: 1; visibility: visible; transition: opacity .45s ease .08s, visibility 0s 0s; }
    body.gsk-ready [data-sk-skeleton] { opacity: 0; visibility: hidden; transition: opacity .45s ease, visibility 0s .45s; }

    /* ============================
       SKELETON COMPONENT STYLES
       ============================ */
    .gsk-text { display: flex; flex-direction: column; gap: 10px; }
    .gsk-line { height: 14px; border-radius: 999px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-line-xs { height: 9px; }
    .gsk-line-sm { height: 11px; }
    .gsk-line-md { height: 16px; }
    .gsk-line-lg { height: 26px; border-radius: 12px; }
    .gsk-line-xl { height: 36px; border-radius: 14px; }
    .gsk-line-2xl { height: 48px; border-radius: 16px; }
    .gsk-image { border-radius: var(--skeleton-radius); background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-circle { border-radius: 9999px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-pill { height: 36px; border-radius: 999px; width: 100px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-avatar { border-radius: 9999px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-stat { height: 48px; border-radius: 12px; width: 100px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-icon { border-radius: 12px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-form-field { height: 54px; border-radius: var(--skeleton-radius); background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-th { height: 12px; border-radius: 6px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-td { height: 16px; border-radius: 8px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }

    /* Card Skeleton */
    .gsk-card { background: var(--skeleton-card-bg); border: 1px solid var(--skeleton-card-border); border-radius: 20px; overflow: hidden; box-shadow: 0 8px 28px rgba(12,12,12,.06); background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-card-body { padding: 18px; display: flex; flex-direction: column; gap: 12px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-card-footer { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-top: 4px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }

    /* List Skeleton */
    .gsk-list { display: flex; flex-direction: column; gap: 14px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-list-item { display: flex; align-items: center; gap: 14px; padding: 4px 0; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-list-lines { flex: 1; gap: 8px; }
    .gsk-list-lines .gsk-line { height: 12px; }

    /* Table Skeleton */
    .gsk-table { display: flex; flex-direction: column; width: 100%; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-table-head, .gsk-tr { display: flex; align-items: center; gap: 6%; }
    .gsk-th, .gsk-td { flex: 1; max-width: 100%; }
    .gsk-table-head { padding: 4px 0 8px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-th { height: 12px; border-radius: 6px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-tr { border-top: 1px solid var(--skeleton-border); padding: 14px 0; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-td { height: 16px; border-radius: 8px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }

    /* Hero/Banner Skeleton */
    .gsk-hero { border-radius: 0; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-banner { height: 100%; border-radius: 0; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-stat-item { background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }

    /* Form Field Skeleton */
    .gsk-form-group { display: flex; flex-direction: column; gap: 8px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-form-label { height: 12px; border-radius: 6px; width: 60px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }

    /* Search Result Card Skeleton */
    .gsk-flight-card { background: var(--skeleton-card-bg); border: 1px solid var(--skeleton-card-border); border-radius: 24px; padding: 24px; box-shadow: 0 4px 16px rgba(12,12,12,.06); background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-flight-header { display: flex; align-items: center; gap: 16px; margin-bottom: 20px; }
    .gsk-flight-airline { width: 48px; height: 48px; border-radius: 16px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-flight-info { flex: 1; display: flex; flex-direction: column; gap: 8px; }
    .gsk-flight-time { height: 24px; border-radius: 12px; width: 80px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-flight-route { height: 14px; border-radius: 999px; width: 120px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-flight-price { height: 32px; border-radius: 12px; width: 80px; margin-left: auto; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-flight-features { display: flex; gap: 12px; margin-top: 16px; }
    .gsk-flight-feature { height: 32px; border-radius: 999px; flex: 1; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-flight-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding-top: 16px; border-top: 1px solid var(--skeleton-border); }

    /* Filter Sidebar Skeleton */
    .gsk-filter-sidebar { background: var(--skeleton-card-bg); border: 1px solid var(--skeleton-card-border); border-radius: 20px; padding: 24px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-filter-item { margin-bottom: 24px; }
    .gsk-filter-title { height: 18px; border-radius: 999px; width: 80px; margin-bottom: 12px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-filter-option { height: 40px; border-radius: 12px; margin-bottom: 8px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-filter-range { height: 12px; border-radius: 6px; width: 100%; margin-bottom: 8px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }

    /* Progress Step Skeleton */
    .gsk-progress { display: flex; align-items: center; justify-content: center; gap: 0; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-progress-step { display: flex; flex-direction: column; align-items: center; gap: 8px; }
    .gsk-progress-icon { width: 40px; height: 40px; border-radius: 50%; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-progress-label { height: 12px; border-radius: 999px; width: 60px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-progress-line { height: 2px; flex: 1; margin: 0 8px; margin-bottom: 24px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }

    /* Section Header Skeleton */
    .gsk-section-header { display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-section-eyebrow { height: 14px; border-radius: 999px; width: 80px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-section-title { height: 32px; border-radius: 12px; width: 250px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }

    /* Stats Skeleton */
    .gsk-stats { display: flex; gap: 16px; background-image: linear-gradient(90deg, var(--skeleton-base) 25%, var(--skeleton-highlight) 50%, var(--skeleton-base) 75%); background-size: 200% 100%; animation: gk-shimmer var(--skeleton-shimmer-duration) ease-in-out infinite; }
    .gsk-stat-item { flex: 1; padding: 16px; border-radius: 16px; display: flex; flex-direction: column; gap: 8px; }
    .gsk-stat-number { height: 32px; border-radius: 12px; width: 60%; }
    .gsk-stat-label { height: 12px; border-radius: 999px; width: 80%; }

    /* ============================
       REDUCED MOTION
       ============================ */
    @media (prefers-reduced-motion: reduce) {
        [data-sk-skeleton] { display: none !important; }
        [data-sk-content] { opacity: 1 !important; visibility: visible !important; transition: none !important; }
        .gk-skel { animation: none !important; background: var(--skeleton-base) !important; }
        .gk-skel::after { display: none !important; }
    }

    /* ============================
       PRINT STYLES
       ============================ */
    @media print {
        [data-sk-skeleton] { display: none !important; }
        [data-sk-content] { opacity: 1 !important; visibility: visible !important; }
        .gk-overlay { display: none !important; }
    }
</style>
<noscript><style>[data-sk-content]{opacity:1!important;visibility:visible!important}[data-sk-skeleton]{display:none!important}</style></noscript>

<div id="gk-overlay" class="gk-overlay" aria-hidden="true">
    <div class="gk-overlay-inner">
        <img src="{{ asset('logo.png') }}" alt="GoZay" class="gk-overlay-logo gk-skel" data-gk-skip/>
        <div class="gk-overlay-bars">
            <div class="gk-overlay-bar w90 gk-skel"></div>
            <div class="gk-overlay-bar w70 gk-skel"></div>
            <div class="gk-overlay-bar w100 gk-skel"></div>
            <div class="gk-overlay-bar w40 gk-skel"></div>
        </div>
        <div class="gk-overlay-planewrap">
            <div class="gk-overlay-plane gk-skel"></div>
        </div>
    </div>
</div>

<script>
    (function () {
        'use strict';

        // ----- Overlay halaman -----
        var overlay = document.getElementById('gk-overlay');
        var gone = false;
        var bootStart = Date.now();

        function hideOverlay() {
            if (gone || !overlay) return;
            gone = true;
            overlay.classList.add('gk-gone');
            setTimeout(function () { if (overlay.parentNode) overlay.parentNode.removeChild(overlay); }, 700);
        }
        function scheduleHide(delay) {
            setTimeout(function () {
                var elapsed = Date.now() - bootStart;
                hideOverlay();
                if (elapsed < 450) setTimeout(hideOverlay, 450 - elapsed);
            }, delay || 0);
        }

        if (document.readyState === 'complete') {
            scheduleHide(400);
        } else {
            window.addEventListener('load', function () { scheduleHide(350); });
            setTimeout(hideOverlay, 2800);
        }

        // ----- Skeleton gambar: shimmer hingga gambar selesai dimuat -----
        function setupImage(img) {
            if (img.getAttribute('data-gk-skip') !== null) return;
            if (img.complete && img.naturalWidth > 0) { img.classList.remove('gk-skel'); return; }
            img.classList.add('gk-skel');
            var done = function () { img.classList.remove('gk-skel'); img.classList.add('gk-loaded'); };
            img.addEventListener('load', done, { once: true });
            img.addEventListener('error', done, { once: true });
        }

        // ----- Skeleton background-image (hero, promo) -----
        function setupBg(el) {
            var match = getComputedStyle(el).backgroundImage.match(/url\(["']?([^"')]+)["']?\)/);
            if (!match || !match[1] || /^data:/i.test(match[1])) return;
            el.classList.add('gk-skel');
            var probe = new Image();
            var done = function () { el.classList.remove('gk-skel'); };
            probe.onload = done;
            probe.onerror = done;
            probe.src = match[1];
        }

        function scan() {
            document.querySelectorAll('img').forEach(setupImage);
            document.querySelectorAll('[data-gk-bg]').forEach(setupBg);
        }

        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            scan();
        } else {
            document.addEventListener('DOMContentLoaded', scan);
        }

        // ----- Zona skeleton: sembunyikan konten, tampilkan kerangka, lalu reveal setelah aset dimuat -----
        var gskReveal = function () {
            if (document.body.classList.contains('gsk-ready')) return;
            document.body.classList.add('gsk-ready');
        };
        if (document.readyState === 'complete') {
            setTimeout(gskReveal, 250);
        } else {
            window.addEventListener('load', function () { setTimeout(gskReveal, 150); });
            setTimeout(gskReveal, 3000);
        }

        document.body.classList.add('gk-booting');
    })();
</script>