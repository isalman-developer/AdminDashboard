/**
 * Auto-initialise Bootstrap Toasts injected by toasts.blade.php
 */

"use strict";

document.addEventListener("DOMContentLoaded", function () {
    // Show every toast element that was server-rendered into the page
    document.querySelectorAll(".toast").forEach(function (toastEl) {
        var delay = parseInt(toastEl.dataset.bsDelay, 10) || 5000;
        var toast = new bootstrap.Toast(toastEl, {
            autohide: true,
            delay: delay,
        });
        toast.show();

        // Remove the element from the DOM once the hide animation finishes
        toastEl.addEventListener("hidden.bs.toast", function () {
            toastEl.remove();
        });
    });
});
