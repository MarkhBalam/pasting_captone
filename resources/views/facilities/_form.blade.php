@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Name</label>
    <input name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $facility->name ?? '') }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Type</label>
    <input name="facility_type" class="form-control @error('facility_type') is-invalid @enderror"
           value="{{ old('facility_type', $facility->facility_type ?? '') }}">
    @error('facility_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Location</label>
    <input name="location" class="form-control @error('location') is-invalid @enderror"
           value="{{ old('location', $facility->location ?? '') }}">
    @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Partner</label>
    <input name="partner_organization" class="form-control @error('partner_organization') is-invalid @enderror"
           value="{{ old('partner_organization', $facility->partner_organization ?? '') }}">
    @error('partner_organization') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-12">
    <label class="form-label">Description</label>
    <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $facility->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>

<div class="mt-3">
  <button class="btn btn-primary">{{ isset($facility) ? 'Update Facility' : 'Create Facility' }}</button>
  <a href="{{ route('facilities.index') }}" class="btn btn-link">Cancel</a>
</div>
