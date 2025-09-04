@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Name</label>
    <input name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $equipment->name ?? '') }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-12">
    <label class="form-label">Description</label>
    <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $equipment->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>
<div class="mt-3">
  <button class="btn btn-primary">{{ isset($equipment) ? 'Update Equipment' : 'Create Equipment' }}</button>
  <a href="{{ route('facilities.equipment.index', $facility) }}" class="btn btn-link">Cancel</a>
</div>
