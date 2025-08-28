@extends('layouts.app')
@section('content')
<div class="row g-3">
    <div class="col-lg-8">
        <div class="card p-4">
            <div class="d-flex align-items-start">
                <div>
                    <h2 class="h4 mb-1">{{ $project->title }}</h2>
                    <div class="text-muted">Program: {{ optional($project->program)->name ?? '—' }}</div>
                </div>
                <a href="{{ route('projects.edit',$project) }}" class="btn btn-outline-secondary btn-sm ms-auto me-2">Edit</a>
                <button type="button" class="btn btn-outline-danger btn-sm"
                        data-delete-url="{{ route('projects.destroy',$project) }}">
                    Delete
                </button>
            </div>
            <hr>
            <p class="mb-2">{{ $project->description ?? 'No description.' }}</p>
            <div class="row">
                <div class="col-md-4"><span class="text-muted">Nature</span><div>{{ $project->nature_of_project }}</div></div>
                <div class="col-md-4"><span class="text-muted">Stage</span><div>{{ $project->prototype_stage ?? '—' }}</div></div>
                <div class="col-md-4"><span class="text-muted">Focus</span><div>{{ $project->innovation_focus ?? '—' }}</div></div>
            </div>
        </div>

        <div class="card p-4 mt-3">
            <h5 class="mb-3">Participants</h5>
            <ul class="list-group list-group-flush">
                @forelse($project->participants as $pt)
                    <li class="list-group-item d-flex align-items-center">
                        <div>
                            <strong>{{ $pt->full_name }}</strong>
                            <div class="small text-muted">{{ $pt->email }}</div>
                            <div class="small">{{ $pt->role_on_project ?? '—' }} • {{ $pt->skill_role ?? '—' }}</div>
                        </div>
                        <a href="{{ route('participants.show',$pt) }}" class="btn btn-sm btn-outline-secondary ms-auto">View</a>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No participants yet.</li>
                @endforelse
            </ul>
            <a href="{{ route('participants.create') }}" class="btn btn-primary btn-sm mt-3">Add Participant</a>
        </div>

        <div class="card p-4 mt-3">
            <h5 class="mb-3">Outcomes</h5>
            <ul class="list-group list-group-flush">
                @forelse($project->outcomes as $o)
                    <li class="list-group-item d-flex align-items-center">
                        <div>
                            <strong>{{ $o->title }}</strong>
                            <div class="small text-muted">{{ $o->outcome_type }}{{ $o->commercialization_status ? ' • '.$o->commercialization_status : '' }}</div>
                            @if($o->artifact_link)
                                <a href="{{ $o->artifact_link }}" target="_blank">Open artifact</a>
                            @endif
                        </div>
                        <a href="{{ route('outcomes.show',$o) }}" class="btn btn-sm btn-outline-secondary ms-auto">View</a>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No outcomes yet.</li>
                @endforelse
            </ul>

            <hr>
            <form class="mt-2" method="post" action="{{ route('projects.outcomes.store',$project) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input class="form-control" name="title" placeholder="Outcome title" required>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" name="outcome_type" placeholder="Type e.g. Prototype" required>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" name="commercialization_status" placeholder="Status e.g. Launched">
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" type="file" name="artifact" />
                    </div>
                    <div class="col-12 mt-2">
                        <textarea class="form-control" name="description" rows="2" placeholder="Description"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary btn-sm mt-2">Add Outcome</button>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card p-4">
            <h5 class="mb-3">Linked Facilities</h5>
            <div class="mb-2">
                @forelse($project->facilities as $f)
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge rounded-pill text-bg-light me-2">{{ $f->name }}</span>
                        <form method="post" action="{{ route('projects.facilities.detach',[$project,$f]) }}" class="ms-auto">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Remove</button>
                        </form>
                    </div>
                @empty
                    <div class="text-muted">No facilities linked.</div>
                @endforelse
            </div>
            <form method="post" action="{{ route('projects.facilities.attach',$project) }}">
                @csrf
                <div class="input-group">
                    <select name="facility_id" class="form-select" required>
                        <option value="">Select facility</option>
                        @foreach($allFacilities as $f)
                            <option value="{{ $f->id }}">{{ $f->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
