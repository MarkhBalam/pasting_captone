@php($edit = isset($project))
@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Title</label>
    <input name="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $project->title ?? '') }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Program</label>
    <select name="program_id" class="form-select @error('program_id') is-invalid @enderror" required>
      <option value="">Select program</option>
      @foreach($programs as $pr)
        <option value="{{ $pr->id }}" @selected(old('program_id', $project->program_id ?? '') == $pr->id)>{{ $pr->name }}</option>
      @endforeach
    </select>
    @error('program_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Nature</label>
    <input name="nature_of_project" class="form-control @error('nature_of_project') is-invalid @enderror"
           value="{{ old('nature_of_project', $project->nature_of_project ?? '') }}" required>
    @error('nature_of_project') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Prototype stage</label>
    <input name="prototype_stage" class="form-control @error('prototype_stage') is-invalid @enderror"
           value="{{ old('prototype_stage', $project->prototype_stage ?? '') }}">
    @error('prototype_stage') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-12">
    <label class="form-label">Description</label>
    <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Innovation focus</label>
    <input name="innovation_focus" class="form-control @error('innovation_focus') is-invalid @enderror"
           value="{{ old('innovation_focus', $project->innovation_focus ?? '') }}">
    @error('innovation_focus') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Facilities (Ctrl+click for multiple)</label>
    <select name="facility_ids[]" class="form-select @error('facility_ids') is-invalid @enderror" multiple>
      @foreach($facilities as $f)
        <option value="{{ $f->id }}"
          @selected(collect(old('facility_ids', isset($project) ? $project->facilities->pluck('id')->all() : []))->contains($f->id))>
          {{ $f->name }}
        </option>
      @endforeach
    </select>
    @error('facility_ids') <div class="invalid-feedback">{{ $message }}</div> @enderror
    @error('facility_ids.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
  </div>
</div>

<div class="mt-3">
  <button class="btn btn-primary">{{ $edit ? 'Update Project' : 'Create Project' }}</button>
  <a href="{{ route('projects.index') }}" class="btn btn-link">Cancel</a>
</div>
