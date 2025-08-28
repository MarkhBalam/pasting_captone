@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center mb-3">
    <h1 class="h3 mb-0">Projects</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary ms-auto">New Project</a>
</div>

<form class="card p-3 mb-3" method="get">
  <div class="row g-2">
    <div class="col-md-6">
      <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search title, focus, stage, nature">
    </div>
    <div class="col-md-3">
      <select class="form-select" name="program_id">
        <option value="">All programs</option>
        @foreach($programs as $pr)
          <option value="{{ $pr->id }}" @selected(request('program_id')==$pr->id)>{{ $pr->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-select" name="facility_id">
        <option value="">All facilities</option>
        @foreach($facilities as $f)
          <option value="{{ $f->id }}" @selected(request('facility_id')==$f->id)>{{ $f->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="mt-2">
    <button class="btn btn-outline-primary btn-sm">Filter</button>
    <a class="btn btn-link btn-sm" href="{{ route('projects.index') }}">Reset</a>
  </div>
</form>

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
                        @if($p->facilities->isEmpty()) — @endif
                    </td>
                    <td><span class="badge badge-soft">{{ $p->prototype_stage ?? '—' }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('projects.edit',$p) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <button type="button" class="btn btn-sm btn-outline-danger"
                                data-delete-url="{{ route('projects.destroy',$p) }}">
                            Delete
                        </button>
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
