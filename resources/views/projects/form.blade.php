@php($edit = isset($project))
@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Title</label>
        <input name="title" class="form-control" value="{{ old('title', $project->title ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Program</label>
        <select name="program_id" class="form-select" required>
            <option value="">Select program</option>
            @foreach($programs as $pr)
                <option value="{{ $pr->id }}" @selected(old('program_id', $project->program_id ?? '') == $pr->id)>{{ $pr->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Nature</label>
        <input name="nature_of_project" class="form-control" value="{{ old('nature_of_project', $project->nature_of_project ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Prototype stage</label>
        <input name="prototype_stage" class="form-control" value="{{ old('prototype_stage', $project->prototype_stage ?? '') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="3" class="form-control">{{ old('description', $project->description ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Innovation focus</label>
        <input name="innovation_focus" class="form-control" value="{{ old('innovation_focus', $project->innovation_focus ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Facilities</label>
        <select name="facility_ids[]" class="form-select" multiple>
            @foreach($facilities as $f)
                <option value="{{ $f->id }}"
                    @selected(collect(old('facility_ids', isset($project) ? $project->facilities->pluck('id')->all() : []))->contains($f->id))>
                    {{ $f->name }}
                </option>
            @endforeach
        </select>
        <div class="form-text">Hold Ctrl, click to select multiple.</div>
    </div>
</div>

<div class="mt-3">
    <button class="btn btn-primary">{{ $edit ? 'Update Project' : 'Create Project' }}</button>
    <a href="{{ route('projects.index') }}" class="btn btn-link">Cancel</a>
</div>
