@extends('layouts.app')
@section('content')
<div class="card p-4">
    <h2 class="h4">{{ $participant->full_name }}</h2>
    <div class="text-muted">{{ $participant->email }}</div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <span class="text-muted">Project</span>
            <div>{{ optional($participant->project)->title ?? '—' }}</div>
        </div>
        <div class="col-md-4">
            <span class="text-muted">Role</span>
            <div>{{ $participant->role_on_project ?? '—' }}</div>
        </div>
        <div class="col-md-4">
            <span class="text-muted">Skill</span>
            <div>{{ $participant->skill_role ?? '—' }}</div>
        </div>
    </div>

    <div class="mt-2">
        <a href="{{ route('participants.edit',$participant) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
        <button type="button" class="btn btn-outline-danger btn-sm"
                data-delete-url="{{ route('participants.destroy',$participant) }}">Delete</button>
    </div>
</div>
@endsection
