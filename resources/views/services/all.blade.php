@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center mb-3">
  <h1 class="h3 mb-0">Services</h1>
</div>

<form class="card p-3 mb-3" method="get" action="{{ route('services.index') }}">
  <div class="row g-2">
    <div class="col-md-10">
      <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search name or description">
    </div>
    <div class="col-md-2">
      <button class="btn btn-outline-primary btn-sm w-100">Filter</button>
    </div>
  </div>
  <div class="mt-2">
    <a class="btn btn-link btn-sm" href="{{ route('services.index') }}">Reset</a>
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
               href="{{ route('services.index', array_merge(request()->all(), ['sort'=>'name','dir'=>$nextDir('name')])) }}">
              Name{!! $arrow('name') !!}
            </a>
          </th>
          <th>Facility</th>
          <th>Description</th>
          <th class="text-nowrap">
            <a class="text-decoration-none"
               href="{{ route('services.index', array_merge(request()->all(), ['sort'=>'created_at','dir'=>$nextDir('created_at')])) }}">
              Created{!! $arrow('created_at') !!}
            </a>
          </th>
          <th class="text-end"></th>
        </tr>
      </thead>
      <tbody>
        @forelse($services as $s)
          <tr>
            <td>{{ $s->name ?? ('#'.$s->id) }}</td>
            <td>
              @if($s->facility)
                <a class="text-decoration-none" href="{{ route('facilities.services.index', $s->facility_id) }}">{{ $s->facility->name }}</a>
              @else — @endif
            </td>
            <td class="text-truncate" style="max-width: 420px;">{{ $s->description ?? '—' }}</td>
            <td class="text-nowrap">{{ $s->created_at?->format('Y-m-d') }}</td>
            <td class="text-end">
              @if($s->facility_id)
                <a href="{{ route('services.edit', $s) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                <button type="button" class="btn btn-sm btn-outline-danger"
                        data-delete-url="{{ route('services.destroy', $s) }}">
                  Delete
                </button>
              @endif
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center text-muted">No services found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $services->links() }}
</div>
@endsection
