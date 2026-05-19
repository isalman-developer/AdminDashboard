async function toggleProductStatus(button) {
    const url = button.dataset.toggleUrl;
    try {
        const response = await fetch(url, {
            method: 'PATCH',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });
        const data = await response.json();
        if (data.success) {
            button.classList.toggle('btn-outline-warning', data.is_active);
            button.classList.toggle('btn-outline-success', !data.is_active);
            const icon = button.querySelector('i');
            icon.className = 'icon-base ti ' + (data.is_active ? 'tabler-pause' : 'tabler-play');
            button.setAttribute('title', data.is_active ? 'Deactivate' : 'Activate');
            const row = button.closest('tr');
            const badge = row.querySelector('.bg-label-success, .bg-label-secondary');
            if (badge) {
                badge.className = data.is_active ? 'badge bg-label-success' : 'badge bg-label-secondary';
                badge.textContent = data.is_active ? 'Active' : 'Inactive';
            }
        } else {
            alert(data.message || 'Unable to toggle product status.');
        }
    } catch (e) {
        alert('Network error. Please try again.');
    }
}

export { toggleProductStatus };
