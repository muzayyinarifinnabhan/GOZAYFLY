/* ============================================================
   GoZay - Script global
   - SweetAlert2 notifikasi (flash session & AJAX error)
   - DataTables inisialisasi otomatis untuk tabel .data-table
   - Konfirmasi Hapus via SweetAlert2
   ============================================================ */

document.addEventListener('DOMContentLoaded', function () {
    initSweetalerts();
    initDataTables();
    initDeleteButtons();
    initConfirmButtons();
});

/* ---------- SweetAlert2: flash session ---------- */
function initSweetalerts() {
    var flash = document.querySelector('meta[name="app-flash"]');
    if (!flash) return;

    var data = {
        type: flash.getAttribute('data-type'),
        message: flash.getAttribute('data-message')
    };

    if (!data.message) return;

    var config = {
        success: { toastClass: 'gz-toast gz-toast-success', icon: 'check_circle', color: '#28a745' },
        error:   { toastClass: 'gz-toast gz-toast-error',   icon: 'error',         color: '#dc3545' },
        warning: { toastClass: 'gz-toast gz-toast-warning', icon: 'warning',       color: '#ffc107' },
        info:    { toastClass: 'gz-toast gz-toast-info',    icon: 'info',          color: '#0d6efd' }
    }[data.type] || config.info;

    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 3200,
        timerProgressBar: true,
        iconHtml: '<span class="material-symbols-outlined">' + config.icon + '</span>',
        title: data.message,
        customClass: {
            popup: config.toastClass,
            closeButton: 'gz-toast-close',
            timerProgressBar: 'gz-toast-progress'
        },
        showClass: { popup: 'gz-toast-animate-in' },
        hideClass: { popup: 'gz-toast-animate-out' }
    });
}

/* ---------- DataTables ---------- */
function initDataTables() {
    document.querySelectorAll('table.data-dt').forEach(function (table) {
        if (window.jQuery && window.jQuery.fn.dataTable) {
            window.jQuery(table).DataTable({
                pageLength: 10,
                language: {
                    lengthMenu: 'Tampilkan _MENU_ baris',
                    zeroRecords: 'Tidak ada data',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(difilter dari _MAX_ total baris)',
                    search: 'Cari:',
                    paginate: { first: 'Pertama', last: 'Terakhir', next: 'Berikutnya', previous: 'Sebelumnya' }
                }
            });
        }
    });
}

/* ---------- Konfirmasi & hapus SweetAlert2 ---------- */
function initDeleteButtons() {
    document.querySelectorAll('.btn-confirm-delete').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            var form = document.querySelector(btn.getAttribute('data-form'));
            var message = btn.getAttribute('data-message') || 'Data yang dihapus tidak bisa dikembalikan!';

            Swal.fire({
                title: 'Hapus data ini?',
                html: message,
                iconHtml: '<span class="material-symbols-outlined">delete</span>',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d62f37',
                cancelButtonColor: '#eef2f7',
                customClass: {
                    popup: 'gz-confirm gz-confirm-danger',
                    confirmButton: 'gz-confirm-btn',
                    cancelButton: 'gz-confirm-btn gz-confirm-btn-ghost'
                },
                reverseButtons: true
            }).then(function (result) {
                if (result.isConfirmed && form) form.submit();
            });
        });
    });
}

/* ---------- Konfirmasi aksi modern (ACC / Tolak / dll) ---------- */
function initConfirmButtons() {
    document.querySelectorAll('.btn-confirm-action').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            var form = document.querySelector(btn.getAttribute('data-form'));
            if (!form) return;

            var variant = btn.getAttribute('data-variant') || 'danger';
            var configs = {
                danger:  { icon: 'delete',          popup: 'gz-confirm gz-confirm-danger',  color: '#d62f37' },
                success: { icon: 'check_circle',    popup: 'gz-confirm gz-confirm-success', color: '#16a34a' },
                warning: { icon: 'warning',         popup: 'gz-confirm gz-confirm-warning', color: '#d97706' }
            };
            var config = configs[variant] || configs.danger;

            Swal.fire({
                title: btn.getAttribute('data-title'),
                html: btn.getAttribute('data-message') || '',
                iconHtml: '<span class="material-symbols-outlined">' + (btn.getAttribute('data-icon') || config.icon) + '</span>',
                showCancelButton: true,
                confirmButtonText: btn.getAttribute('data-confirm-text') || 'Ya',
                cancelButtonText: btn.getAttribute('data-cancel-text') || 'Batal',
                confirmButtonColor: config.color,
                cancelButtonColor: '#eef2f7',
                customClass: {
                    popup: config.popup,
                    confirmButton: 'gz-confirm-btn',
                    cancelButton: 'gz-confirm-btn gz-confirm-btn-ghost'
                },
                reverseButtons: true
            }).then(function (result) {
                if (result.isConfirmed) form.submit();
            });
        });
    });
}