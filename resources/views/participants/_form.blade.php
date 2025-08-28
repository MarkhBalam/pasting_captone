@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Full name</label>
    <input name="full_name" class="form-control @error('full_name') is-invalid @enderror"
           value="{{ old('full_name', $participant->full_name ?? '') }}" required>
    @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $participant->email ?? '') }}" required>
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Project</label>
    <select name="project_id" class="form-select @error('project_id') is-invalid @enderror" required>
      <option value="">Select project</option>
      @foreach($projects as $p)
        <option value="{{ $p->id }}" @selected(old('project_id', $participant->project_id ?? '') == $p->id)>{{ $p->title }}</option>
      @endforeach
    </select>
    @error('project_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Role</label>
    <input name="role_on_project" class="form-control @error('role_on_project') is-invalid @enderror"
           value="{{ old('role_on_project', $participant->role_on_project ?? '') }}">
    @error('role_on_project') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Skill role</label>
    <input name="skill_role" class="form-control @error('skill_role') is-invalid @enderror"
           value="{{ old('skill_role', $participant->skill_role ?? '') }}">
    @error('skill_role') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Institution</label>
    <input name="institution" class="form-control @error('institution') is-invalid @enderror"
           value="{{ old('institution', $participant->institution ?? '') }}">
    @error('institution') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-12">
    <div class="form-check mt-2">
      <input class="form-check-input @error('cross_skill_trained') is-invalid @enderror"
             type="checkbox" name="cross_skill_trained" value="1"
             {{ old('cross_skill_trained', $participant->cross_skill_trained ?? false) ? 'checked' : '' }}>
      <label class="form-check-label">Cross-skill trained</label>
      @error('cross_skill_trained') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
  </div>
</div>

<div class="mt-3">
  <button class="btn btn-primary">{{ isset($participant) ? 'Update' : 'Create' }}</button>
  <a href="{{ route('participants.index') }}" class="btn btn-link">Cancel</a>
</div>
