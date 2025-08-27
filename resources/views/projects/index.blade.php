@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center mb-3">
    <h1 class="h3 mb-0">Projects</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary ms-auto">New Project</a>
</div>

<div class="card p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>Title</th>
                <th>Program</th>
                <th>Facilities</th>
                <th>Stage</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($projects as $p)
                <tr>
                    <td><a href="{{ route('projects.show',$p) }}" class="text-decoration-none">{{ $p->title }}</a></td>
                    <td>{{ optional($p->program)->name ?? '—' }}</td>
                    <td>
                        @foreach($p->facilities as $f)
                            <span class="badge rounded-pill text-bg-light">{{ $f->name }}</span>
                        @endforeach
                        @if($p->facilities->isEmpty()) —
                        @endif
                    </td>
                    <td><span class="badge badge-soft">{{ $p->prototype_stage ?? '—' }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('projects.edit',$p) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">No projects yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $projects->links() }}
</div>
@endsection
