@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center mb-3">
    <h1 class="h3 mb-0">Facilities</h1>
    <a href="{{ route('facilities.create') }}" class="btn btn-primary ms-auto">New Facility</a>
</div>
<div class="card p-3">
    <table class="table align-middle">
        <thead><tr><th>Name</th><th>Type</th><th>Partner</th><th></th></tr></thead>
        <tbody>
        @forelse($facilities as $f)
            <tr>
                <td><a href="{{ route('facilities.show',$f) }}" class="text-decoration-none">{{ $f->name }}</a></td>
                <td>{{ $f->facility_type ?? '—' }}</td>
                <td>{{ $f->partner_organization ?? '—' }}</td>
                <td class="text-end"><a href="{{ route('facilities.edit',$f) }}" class="btn btn-sm btn-outline-secondary">Edit</a></td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center text-muted">No facilities yet.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $facilities->links() }}
</div>
@endsection
