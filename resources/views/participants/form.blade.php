@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Full name</label>
        <input name="full_name" class="form-control" value="{{ old('full_name', $participant->full_name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $participant->email ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Project</label>
        <select name="project_id" class="form-select" required>
            <option value="">Select project</option>
            @foreach($projects as $p)
                <option value="{{ $p->id }}" @selected(old('project_id', $participant->project_id ?? '') == $p->id)>{{ $p->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Role</label>
        <input name="role_on_project" class="form-control" value="{{ old('role_on_project', $participant->role_on_project ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Skill role</label>
        <input name="skill_role" class="form-control" value="{{ old('skill_role', $participant->skill_role ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Institution</label>
        <input name="institution" class="form-control" value="{{ old('institution', $participant->institution ?? '') }}">
    </div>
</div>
<div class="mt-3">
    <button class="btn btn-primary">{{ isset($participant) ? 'Update' : 'Create' }}</button>
    <a href="{{ route('participants.index') }}" class="btn btn-link">Cancel</a>
</div>
