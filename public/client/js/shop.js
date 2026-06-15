(function () {
    "use strict";

    // ─── PRICE SLIDER (nouislider) ───────────────────────────
    const sliderEl = document.getElementById("price-slider");

    if (sliderEl && typeof noUiSlider !== "undefined") {
        const globalMin = parseFloat(sliderEl.dataset.min) || 0;
        const globalMax = parseFloat(sliderEl.dataset.max) || 9999;
        const startMin = parseFloat(sliderEl.dataset.startMin) || globalMin;
        const startMax = parseFloat(sliderEl.dataset.startMax) || globalMax;

        const minDisplay = document.getElementById("price-min-display");
        const maxDisplay = document.getElementById("price-max-display");
        const minInput = document.getElementById("price-min-input");
        const maxInput = document.getElementById("price-max-input");

        noUiSlider.create(sliderEl, {
            start: [startMin, startMax],
            connect: true,
            range: { min: globalMin, max: globalMax },
            step: 1,
        });

        sliderEl.noUiSlider.on("update", function (values) {
            const lo = Math.round(values[0]);
            const hi = Math.round(values[1]);

            if (minDisplay) minDisplay.textContent = lo;
            if (maxDisplay) maxDisplay.textContent = hi;
            if (minInput) minInput.value = lo;
            if (maxInput) maxInput.value = hi;
        });

        // Submit form only when user releases handle (avoids mid-drag submits)
        sliderEl.noUiSlider.on("change", function () {
            // On desktop auto-submit; on mobile user clicks Apply
            if (window.innerWidth >= 992) {
                const form = document.getElementById("filter-form");
                if (form) form.submit();
            }
        });
    }

    // ─── CHECKBOX AUTO-SUBMIT (desktop only) ─────────────────
    document.querySelectorAll(".filter-checkbox").forEach(function (cb) {
        cb.addEventListener("change", function () {
            if (window.innerWidth >= 992) {
                const form = document.getElementById("filter-form");
                if (form) form.submit();
            }
        });
    });

    // ─── SORT DROPDOWN ───────────────────────────────────────
    const sortSelect = document.getElementById("sort-select");
    if (sortSelect) {
        sortSelect.addEventListener("change", function () {
            const hiddenSortBy = document.getElementById("hidden-sort-by");
            if (hiddenSortBy) hiddenSortBy.value = this.value;

            const form = document.getElementById("filter-form");
            if (form) form.submit();
        });
    }
})();
