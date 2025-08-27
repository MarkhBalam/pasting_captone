@extends('layouts.app')
@section('content')
<h1 class="h5 mb-3">New Service for {{ $facility->name }}</h1>
<div class="card p-4">
    <form method="post" action="{{ route('facilities.services.store',$facility) }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Name</label><input name="name" class="form-control" required></div>
            <div class="col-md-3"><label class="form-label">Category</label><input name="category" class="form-control" required></div>
            <div class="col-md-3"><label class="form-label">Skill type</label><input name="skill_type" class="form-control" required></div>
            <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
        </div>
        <button class="btn btn-primary mt-3">Create</button>
        <a href="{{ route('facilities.show',$facility) }}" class="btn btn-link">Cancel</a>
    </form>
</div>
@endsection
