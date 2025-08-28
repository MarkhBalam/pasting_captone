@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center mb-3">
    <h1 class="h3 mb-0">Programs</h1>
    <a href="{{ route('programs.create') }}" class="btn btn-primary ms-auto">New Program</a>
</div>

{{-- Filters --}}
<form class="card p-3 mb-3" method="get">
  <div class="row g-2">
    <div class="col-md-8">
      <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search name, description, alignment">
    </div>
    <div class="col-md-3">
      <select class="form-select" name="alignment">
        <option value="">All alignments</option>
        @isset($alignments)
          @foreach($alignments as $a)
            <option value="{{ $a }}" @selected(request('alignment')==$a)>{{ $a }}</option>
          @endforeach
        @endisset
      </select>
    </div>
    <div class="col-md-1">
      <button class="btn btn-outline-primary btn-sm w-100">Go</button>
    </div>
  </div>
  <div class="mt-2">
    <a class="btn btn-link btn-sm" href="{{ route('programs.index') }}">Reset</a>
  </div>
</form>

<div class="card p-3">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Name</th>
                <th>Projects</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse($programs as $pr)
            <tr>
                <td>
                  <a href="{{ route('programs.show',$pr) }}" class="text-decoration-none">
                    {{ $pr->name }}
                  </a>
                  @if($pr->national_alignment)
                    <div class="small text-muted">{{ $pr->national_alignment }}</div>
                  @endif
                </td>
                <td>{{ $pr->projects_count }}</td>
                <td class="text-end">
                    <a href="{{ route('programs.edit',$pr) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <button type="button" class="btn btn-sm btn-outline-danger"
                            data-delete-url="{{ route('programs.destroy',$pr) }}">
                        Delete
                    </button>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="text-center text-muted">No programs yet.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $programs->links() }}
</div>
@endsection
