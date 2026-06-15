(function () {
    "use strict";

    const filterForm = document.getElementById("filter-form");
    const sliderEl   = document.getElementById("price-slider");

    // ─── PRICE SLIDER (nouislider) ───────────────────────────
    if (sliderEl && typeof noUiSlider !== "undefined") {
        const globalMin = parseFloat(sliderEl.dataset.min)  || 0;
        const globalMax = parseFloat(sliderEl.dataset.max)  || 9999;

        // Safe parse: avoid falsy-zero bug where parseFloat(0) || fallback = fallback
        function safeParse(val, fallback) {
            var n = parseFloat(val);
            return (val !== "" && val != null && isFinite(n)) ? n : fallback;
        }
        const startMin = safeParse(sliderEl.dataset.startMin, globalMin);
        const startMax = safeParse(sliderEl.dataset.startMax, globalMax);

        const minDisplay = document.getElementById("price-min-display");
        const maxDisplay = document.getElementById("price-max-display");
        const minInput   = document.getElementById("price-min-input");
        const maxInput   = document.getElementById("price-max-input");

        noUiSlider.create(sliderEl, {
            start:   [startMin, startMax],
            connect: true,
            range:   { min: globalMin, max: globalMax },
            step:    1,
        });

        sliderEl.noUiSlider.on("update", function (values) {
            var lo = Math.round(values[0]);
            var hi = Math.round(values[1]);
            if (minDisplay) minDisplay.textContent = lo;
            if (maxDisplay) maxDisplay.textContent = hi;
            if (minInput)   minInput.value = lo;
            if (maxInput)   maxInput.value = hi;
        });

        // Auto-submit on desktop when handle is released
        sliderEl.noUiSlider.on("change", function () {
            if (window.innerWidth >= 992 && filterForm) filterForm.submit();
        });

        // Keep URL clean: strip price params when slider is at the full global range
        // so unconfigured price doesn't pollute the URL on every checkbox/sort submit
        if (filterForm) {
            filterForm.addEventListener("submit", function () {
                if (minInput && maxInput &&
                    parseInt(minInput.value) === globalMin &&
                    parseInt(maxInput.value) === globalMax) {
                    minInput.removeAttribute("name");
                    maxInput.removeAttribute("name");
                }
            });
        }
    }

    // ─── CHECKBOX AUTO-SUBMIT (desktop only) ─────────────────
    document.querySelectorAll(".filter-checkbox").forEach(function (cb) {
        cb.addEventListener("change", function () {
            if (window.innerWidth >= 992 && filterForm) filterForm.submit();
        });
    });

    // ─── SORT DROPDOWN ───────────────────────────────────────
    var sortSelect = document.getElementById("sort-select");
    if (sortSelect) {
        sortSelect.addEventListener("change", function () {
            var hiddenSortBy = document.getElementById("hidden-sort-by");
            if (hiddenSortBy) hiddenSortBy.value = this.value;
            if (filterForm) filterForm.submit();
        });
    }
})();
