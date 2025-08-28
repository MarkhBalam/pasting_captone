<style>
  .toast-stack {
    position: fixed; top: 1rem; right: 1rem; z-index: 1080; /* above modals */
  }
</style>

<div class="toast-stack">
  {{-- Success / info flash --}}
  @if(session('status'))
    <div class="toast align-items-center text-bg-success border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">{{ session('status') }}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif

  {{-- Explicit error flash (e.g., from controllers) --}}
  @if(session('error'))
    <div class="toast align-items-center text-bg-danger border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">{{ session('error') }}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif

  {{-- Generic “fix errors” toast when there are validation errors --}}
  @if($errors->any())
    <div class="toast align-items-center text-bg-warning border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">Please fix the highlighted fields below.</div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toast-stack .toast').forEach(function (el) {
      new bootstrap.Toast(el, { delay: 4000 }).show();
    });
  });
</script>
