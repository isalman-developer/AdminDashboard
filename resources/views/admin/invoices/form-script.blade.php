<script>
(function () {
    'use strict';

    function fmt(n) {
        return '$' + parseFloat(n || 0).toFixed(2);
    }

    window.recalc = function () {
        var subtotal  = parseFloat(
            document.querySelector('[data-subtotal]').dataset.subtotal
        ) || 0;
        var discPct   = parseFloat(document.getElementById('discount-pct').value) || 0;
        var taxPct    = parseFloat(document.getElementById('tax-pct').value) || 0;

        var discAmt = subtotal * (discPct / 100);
        var taxAmt  = (subtotal - discAmt) * (taxPct / 100);
        var total   = subtotal - discAmt + taxAmt;

        document.getElementById('display-discount').textContent = '-' + fmt(discAmt);
        document.getElementById('display-tax').textContent      = fmt(taxAmt);
        document.getElementById('display-total').textContent    = fmt(total);
    };

    recalc();
})();
</script>
