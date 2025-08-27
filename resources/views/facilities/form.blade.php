@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input name="name" class="form-control" value="{{ old('name', $facility->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Type</label>
        <input name="facility_type" class="form-control" value="{{ old('facility_type', $facility->facility_type ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Location</label>
        <input name="location" class="form-control" value="{{ old('location', $facility->location ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Partner</label>
        <input name="partner_organization" class="form-control" value="{{ old('partner_organization', $facility->partner_organization ?? '') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="3" class="form-control">{{ old('description', $facility->description ?? '') }}</textarea>
    </div>
</div>
<div class="mt-3">
    <button class="btn btn-primary">{{ isset($facility) ? 'Update Facility' : 'Create Facility' }}</button>
    <a href="{{ route('facilities.index') }}" class="btn btn-link">Cancel</a>
</div>
