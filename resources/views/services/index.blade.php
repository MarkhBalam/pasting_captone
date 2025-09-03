@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center mb-3">
  <h1 class="h3 mb-0">Services · {{ $facility->name }}</h1>
  <a href="{{ route('facilities.services.create', $facility) }}" class="btn btn-primary ms-auto">New Service</a>
</div>

{{-- Filters --}}
<form class="card p-3 mb-3" method="get" action="{{ route('facilities.services.index', $facility) }}">
  <div class="row g-2">
    <div class="col-md-10">
      <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search name or description">
    </div>
    <div class="col-md-2">
      <button class="btn btn-outline-primary btn-sm w-100">Filter</button>
    </div>
  </div>
  <div class="mt-2">
    <a class="btn btn-link btn-sm" href="{{ route('facilities.services.index', $facility) }}">Reset</a>
  </div>
</form>

<div class="card p-3">
  <div class="table-responsive">
    <table class="table align-middle">
      @php
        $nextDir = fn($col) => (request('sort') === $col && request('dir') === 'asc') ? 'desc' : 'asc';
        $arrow = function($col) {
          if(request('sort') !== $col) return '';
          return request('dir') === 'asc' ? ' ▲' : ' ▼';
        };
      @endphp
      <thead>
        <tr>
          <th>
            <a class="text-decoration-none"
               href="{{ route('facilities.services.index', array_merge(['facility'=>$facility->id], request()->all(), ['sort'=>'name','dir'=>$nextDir('name')])) }}">
              Name{!! $arrow('name') !!}
            </a>
          </th>
          <th>Description</th>
          <th class="text-nowrap">
            <a class="text-decoration-none"
               href="{{ route('facilities.services.index', array_merge(['facility'=>$facility->id], request()->all(), ['sort'=>'created_at','dir'=>$nextDir('created_at')])) }}">
              Created{!! $arrow('created_at') !!}
            </a>
          </th>
          <th class="text-end"></th>
        </tr>
      </thead>
      <tbody>
        @forelse($services as $s)
          <tr>
            <td>{{ $s->name }}</td>
            <td class="text-truncate" style="max-width: 420px;">{{ $s->description ?? '—' }}</td>
            <td class="text-nowrap">{{ $s->created_at?->format('Y-m-d') }}</td>
            <td class="text-end">
              <a href="{{ route('services.edit', $s) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
              <button type="button" class="btn btn-sm btn-outline-danger"
                      data-delete-url="{{ route('services.destroy', $s) }}">
                Delete
              </button>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center text-muted">No services yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $services->links() }}
</div>
@endsection
