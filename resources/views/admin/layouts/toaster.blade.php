<!-- ============================================
     TOAST NOTIFICATION SYSTEM
     Centralized - called from toaster.blade.php
     Usage: showToast('success'|'error'|'warning'|'info', 'message')
     ============================================ -->

<div id="toast-container"></div>

<script>
    // ── Toast System ────────────────────────────────────────────────────
    const TOAST_ICONS = {
        success: '<i class="fas fa-check-circle"></i>',
        error: '<i class="fas fa-times-circle"></i>',
        warning: '<i class="fas fa-exclamation-triangle"></i>',
        info: '<i class="fas fa-info-circle"></i>',
    };

    function showToast(type, message, duration = 4000) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const id = 'toast-' + Date.now();
        const toast = document.createElement('div');
        toast.id = id;
        toast.className = `toast-item toast-${type}`;
        toast.innerHTML = `
            <div class="toast-icon">${TOAST_ICONS[type] || TOAST_ICONS.info}</div>
            <span class="toast-msg">${escapeHtml(message)}</span>
            <button class="toast-close" onclick="closeToast('${id}')" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>`;

        container.appendChild(toast);

        // Animate in
        requestAnimationFrame(() => {
            requestAnimationFrame(() => toast.classList.add('show'));
        });

        // Auto remove
        if (duration > 0) {
            setTimeout(() => closeToast(id), duration);
        }
    }

    function closeToast(id) {
        const toast = document.getElementById(id);
        if (!toast) return;
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 350);
    }

    function escapeHtml(text) {
        const d = document.createElement('div');
        d.appendChild(document.createTextNode(text));
        return d.innerHTML;
    }

    // ── Fire Laravel Session Flash Messages ─────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            showToast('success', @json(session('success')));
        @endif

        @if(session('error'))
            showToast('error', @json(session('error')));
        @endif

        @if(session('warning'))
            showToast('warning', @json(session('warning')));
        @endif

        @if(session('info'))
            showToast('info', @json(session('info')));
        @endif
    });
</script>