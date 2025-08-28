@extends('layouts.app')
@section('content')
<h1 class="h3 mb-3">Outcomes</h1>

{{-- Filters --}}
<form class="card p-3 mb-3" method="get">
  <div class="row g-2">
    <div class="col-md-4">
      <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search title/description">
    </div>
    <div class="col-md-3">
      <select class="form-select" name="project_id">
        <option value="">All projects</option>
        @isset($projects)
          @foreach($projects as $p)
            <option value="{{ $p->id }}" @selected(request('project_id')==$p->id)>{{ $p->title }}</option>
          @endforeach
        @endisset
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-select" name="outcome_type">
        <option value="">All types</option>
        @isset($types)
          @foreach($types as $t)
            <option value="{{ $t }}" @selected(request('outcome_type')==$t)>{{ $t }}</option>
          @endforeach
        @endisset
      </select>
    </div>
    <div class="col-md-2">
      <select class="form-select" name="commercialization_status">
        <option value="">Any status</option>
        @isset($statuses)
          @foreach($statuses as $s)
            <option value="{{ $s }}" @selected(request('commercialization_status')==$s)>{{ $s }}</option>
          @endforeach
        @endisset
      </select>
    </div>
  </div>
  <div class="mt-2">
    <button class="btn btn-outline-primary btn-sm">Filter</button>
    <a class="btn btn-link btn-sm" href="{{ route('outcomes.index') }}">Reset</a>
  </div>
</form>

<div class="card p-3">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Title</th>
                <th>Project</th>
                <th>Type</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse($outcomes as $o)
            <tr>
                <td>
                    <a href="{{ route('outcomes.show',$o) }}" class="text-decoration-none">{{ $o->title }}</a>
                    @if($o->artifact_link)
                      <div class="small"><a href="{{ $o->artifact_link }}" target="_blank">Artifact</a></div>
                    @endif
                </td>
                <td>{{ optional($o->project)->title ?? '—' }}</td>
                <td>{{ $o->outcome_type ?? '—' }}</td>
                <td>{{ $o->commercialization_status ?? '—' }}</td>
                <td class="text-end">
                    <a href="{{ route('outcomes.edit',$o) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <button type="button" class="btn btn-sm btn-outline-danger"
                            data-delete-url="{{ route('outcomes.destroy',$o) }}">
                        Delete
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">No outcomes yet.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $outcomes->links() }}
</div>
@endsection
