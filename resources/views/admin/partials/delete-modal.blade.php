<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="deleteModalForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="deleteModalName"></strong>?</p>
                    <p class="text-danger small">
                        <i class="icon-base ti tabler-alert-triangle"></i>
                        This action cannot be undone.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('[data-delete-name]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('deleteModalName').textContent = this.dataset.deleteName;
            document.getElementById('deleteModalForm').action = this.dataset.deleteUrl;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        });
    });
</script>
@endpush
