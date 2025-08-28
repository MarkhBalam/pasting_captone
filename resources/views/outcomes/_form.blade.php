@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Project</label>
    <select name="project_id" class="form-select @error('project_id') is-invalid @enderror" required>
      <option value="">Select project</option>
      @foreach($projects as $p)
        <option value="{{ $p->id }}" @selected(old('project_id', $outcome->project_id ?? $project->id ?? '') == $p->id)>{{ $p->title }}</option>
      @endforeach
    </select>
    @error('project_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Title</label>
    <input name="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $outcome->title ?? '') }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-12">
    <label class="form-label">Description</label>
    <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $outcome->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Outcome type</label>
    <input name="outcome_type" class="form-control @error('outcome_type') is-invalid @enderror"
           value="{{ old('outcome_type', $outcome->outcome_type ?? '') }}" required>
    @error('outcome_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Quality certification</label>
    <input name="quality_certification" class="form-control @error('quality_certification') is-invalid @enderror"
           value="{{ old('quality_certification', $outcome->quality_certification ?? '') }}">
    @error('quality_certification') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Commercialization status</label>
    <input name="commercialization_status" class="form-control @error('commercialization_status') is-invalid @enderror"
           value="{{ old('commercialization_status', $outcome->commercialization_status ?? '') }}">
    @error('commercialization_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Artifact (file)</label>
    <input type="file" name="artifact" class="form-control @error('artifact') is-invalid @enderror">
    @error('artifact') <div class="invalid-feedback">{{ $message }}</div> @enderror
    @if(!empty($outcome?->artifact_link))
      <div class="form-text"><a href="{{ $outcome->artifact_link }}" target="_blank">Current file</a></div>
    @endif
  </div>
</div>

<div class="mt-3">
  <button class="btn btn-primary">{{ isset($outcome) ? 'Update Outcome' : 'Create Outcome' }}</button>
  <a href="{{ route('outcomes.index') }}" class="btn btn-link">Cancel</a>
</div>
