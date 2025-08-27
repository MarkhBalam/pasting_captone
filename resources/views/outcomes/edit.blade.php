@extends('layouts.app')
@section('content')
<h1 class="h5 mb-3">Edit Outcome</h1>
<div class="card p-4">
    <form method="post" action="{{ route('outcomes.update',$outcome) }}" enctype="multipart/form-data">
        @method('PUT') @csrf
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Title</label><input name="title" class="form-control" value="{{ old('title',$outcome->title) }}" required></div>
            <div class="col-md-3"><label class="form-label">Type</label><input name="outcome_type" class="form-control" value="{{ old('outcome_type',$outcome->outcome_type) }}" required></div>
            <div class="col-md-3"><label class="form-label">Status</label><input name="commercialization_status" class="form-control" value="{{ old('commercialization_status',$outcome->commercialization_status) }}"></div>
            <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description',$outcome->description) }}</textarea></div>
            <div class="col-12"><label class="form-label">Replace artifact</label><input type="file" name="artifact" class="form-control"></div>
        </div>
        <button class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('outcomes.show',$outcome) }}" class="btn btn-link">Cancel</a>
    </form>
</div>
@endsection
