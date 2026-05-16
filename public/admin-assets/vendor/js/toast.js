/**
 * Auto-initialise Bootstrap Toasts injected by toasts.blade.php
 */

"use strict";

document.addEventListener("DOMContentLoaded", function () {
    // Show every toast element that was server-rendered into the page
    document.querySelectorAll(".toast").forEach(function (toastEl) {
        var toast = new bootstrap.Toast(toastEl, {
            autohide: true,
            delay: 300000000,
        });
        toast.show();

        // Remove the element from the DOM once the hide animation finishes
        toastEl.addEventListener("hidden.bs.toast", function () {
            toastEl.remove();
        });
    });
});
