<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Confirm deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        This action cannot be undone. Are you sure?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
        <form id="confirmDeleteForm" method="POST" action="#">
          @csrf @method('DELETE')
          <button class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('click', function (e) {
  const btn = e.target.closest('[data-delete-url]');
  if (!btn) return;
  const form = document.getElementById('confirmDeleteForm');
  form.action = btn.getAttribute('data-delete-url');
  const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
  modal.show();
});
</script>
