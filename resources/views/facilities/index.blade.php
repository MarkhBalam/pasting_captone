@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center mb-3">
    <h1 class="h3 mb-0">Facilities</h1>
    <a href="{{ route('facilities.create') }}" class="btn btn-primary ms-auto">New Facility</a>
</div>

{{-- Filters --}}
<form class="card p-3 mb-3" method="get">
  <div class="row g-2">
    <div class="col-md-5">
      <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search name, location, description">
    </div>
    <div class="col-md-3">
      <select class="form-select" name="type">
        <option value="">All types</option>
        @isset($types)
          @foreach($types as $t)
            <option value="{{ $t }}" @selected(request('type')==$t)>{{ $t }}</option>
          @endforeach
        @endisset
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-select" name="partner">
        <option value="">All partners</option>
        @isset($partners)
          @foreach($partners as $p)
            <option value="{{ $p }}" @selected(request('partner')==$p)>{{ $p }}</option>
          @endforeach
        @endisset
      </select>
    </div>
    <div class="col-md-1">
      <button class="btn btn-outline-primary btn-sm w-100">Go</button>
    </div>
  </div>
  <div class="mt-2">
    <div class="input-group input-group-sm" style="max-width: 340px;">
      <span class="input-group-text">Capability</span>
      <input class="form-control" name="capability" value="{{ request('capability') }}" placeholder="e.g. 3D Printing">
      <a class="btn btn-link btn-sm ms-2" href="{{ route('facilities.index') }}">Reset</a>
    </div>
  </div>
</form>

<div class="card p-3">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Partner</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse($facilities as $f)
            <tr>
                <td><a href="{{ route('facilities.show',$f) }}" class="text-decoration-none">{{ $f->name }}</a></td>
                <td>{{ $f->facility_type ?? '—' }}</td>
                <td>{{ $f->partner_organization ?? '—' }}</td>
                <td class="text-end">
                    <a href="{{ route('facilities.edit',$f) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <button type="button" class="btn btn-sm btn-outline-danger"
                            data-delete-url="{{ route('facilities.destroy',$f) }}">
                        Delete
                    </button>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center text-muted">No facilities yet.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $facilities->links() }}
</div>
@endsection
