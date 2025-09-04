@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center mb-3">
  <h1 class="h3 mb-0">Equipment · {{ $facility->name }}</h1>
  <a href="{{ route('facilities.equipment.create', $facility) }}" class="btn btn-primary ms-auto">New Equipment</a>
</div>

<form class="card p-3 mb-3" method="get" action="{{ route('facilities.equipment.index', $facility) }}">
  <div class="row g-2">
    <div class="col-md-10">
      <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search name or description">
    </div>
    <div class="col-md-2">
      <button class="btn btn-outline-primary btn-sm w-100">Filter</button>
    </div>
  </div>
  <div class="mt-2">
    <a class="btn btn-link btn-sm" href="{{ route('facilities.equipment.index', $facility) }}">Reset</a>
  </div>
</form>

<div class="card p-3">
  @php
    $nextDir = fn($col) => (request('sort') === $col && request('dir') === 'asc') ? 'desc' : 'asc';
    $arrow = function($col) {
      if(request('sort') !== $col) return '';
      return request('dir') === 'asc' ? ' ▲' : ' ▼';
    };
  @endphp

  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>
            <a class="text-decoration-none"
               href="{{ route('facilities.equipment.index', array_merge(['facility'=>$facility->id], request()->all(), ['sort'=>'name','dir'=>$nextDir('name')])) }}">
              Name{!! $arrow('name') !!}
            </a>
          </th>
          <th>Description</th>
          <th class="text-nowrap">
            <a class="text-decoration-none"
               href="{{ route('facilities.equipment.index', array_merge(['facility'=>$facility->id], request()->all(), ['sort'=>'created_at','dir'=>$nextDir('created_at')])) }}">
              Created{!! $arrow('created_at') !!}
            </a>
          </th>
          <th class="text-end"></th>
        </tr>
      </thead>
      <tbody>
        @forelse($equipment as $e)
          <tr>
            <td>{{ $e->name ?? ('#'.$e->id) }}</td>
            <td class="text-truncate" style="max-width: 420px;">{{ $e->description ?? '—' }}</td>
            <td class="text-nowrap">{{ $e->created_at?->format('Y-m-d') }}</td>
            <td class="text-end">
              <a href="{{ route('equipment.edit', $e) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
              <button type="button" class="btn btn-sm btn-outline-danger"
                      data-delete-url="{{ route('equipment.destroy', $e) }}">
                Delete
              </button>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center text-muted">No equipment yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $equipment->links() }}
</div>
@endsection
