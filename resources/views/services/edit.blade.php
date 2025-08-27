@extends('layouts.app')
@section('content')
<h1 class="h5 mb-3">Edit Service</h1>
<div class="card p-4">
    <form method="post" action="{{ route('services.update',$service) }}">
        @method('PUT') @csrf
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Name</label><input name="name" class="form-control" value="{{ old('name',$service->name) }}" required></div>
            <div class="col-md-3"><label class="form-label">Category</label><input name="category" class="form-control" value="{{ old('category',$service->category) }}" required></div>
            <div class="col-md-3"><label class="form-label">Skill type</label><input name="skill_type" class="form-control" value="{{ old('skill_type',$service->skill_type) }}" required></div>
            <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description',$service->description) }}</textarea></div>
        </div>
        <button class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('services.show',$service) }}" class="btn btn-link">Cancel</a>
    </form>
</div>
@endsection
