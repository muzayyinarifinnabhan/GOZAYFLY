@php
    // Baca pesan flash session untuk ditampilkan via SweetAlert2
    $flashType = session('success') ? 'success' : (session('error') ? 'error' : (session('warning') ? 'warning' : (session('info') ? 'info' : null)));
    $flashMessage = $flashType ? session($flashType) : null;
    $statusMessage = session('status');
@endphp
@if ($flashType || $statusMessage)
    <meta name="app-flash" data-type="{{ $flashType ?? 'info' }}" data-message="{{ $flashMessage ?? $statusMessage }}">
@endif
