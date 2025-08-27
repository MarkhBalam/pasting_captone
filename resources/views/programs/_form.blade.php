@csrf
<div class="mb-3">
  <label class="form-label">Name</label>
  <input name="name" class="form-control" value="{{ old('name', $program->name ?? '') }}" required>
</div>
<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description" class="form-control" rows="3">{{ old('description', $program->description ?? '') }}</textarea>
</div>
<div class="mb-3">
  <label class="form-label">National alignment</label>
  <input name="national_alignment" class="form-control" value="{{ old('national_alignment', $program->national_alignment ?? '') }}">
</div>
<div class="mt-2">
  <button class="btn btn-primary">{{ isset($program) ? 'Update Program' : 'Create Program' }}</button>
  <a href="{{ route('programs.index') }}" class="btn btn-link">Cancel</a>
</div>
