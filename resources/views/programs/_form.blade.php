@csrf
<div class="mb-3">
  <label class="form-label">Name</label>
  <input name="name" class="form-control @error('name') is-invalid @enderror"
         value="{{ old('name', $program->name ?? '') }}" required>
  @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $program->description ?? '') }}</textarea>
  @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">National alignment</label>
  <input name="national_alignment" class="form-control @error('national_alignment') is-invalid @enderror"
         value="{{ old('national_alignment', $program->national_alignment ?? '') }}">
  @error('national_alignment') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mt-2">
  <button class="btn btn-primary">{{ isset($program) ? 'Update Program' : 'Create Program' }}</button>
  <a href="{{ route('programs.index') }}" class="btn btn-link">Cancel</a>
</div>
