@extends('layouts.app')
@section('content')
<div class="card p-4">
    <h2 class="h4 mb-1">{{ $facility->name }}</h2>
    <div class="text-muted mb-3">{{ $facility->facility_type ?? '—' }} • {{ $facility->partner_organization ?? '—' }}</div>
    <p>{{ $facility->description ?? 'No description.' }}</p>

    <div class="mt-2">
        <a href="{{ route('facilities.edit',$facility) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
        <button type="button" class="btn btn-outline-danger btn-sm"
                data-delete-url="{{ route('facilities.destroy',$facility) }}">
            Delete
        </button>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-lg-6">
        <div class="card p-4">
            <h5 class="mb-3">Services</h5>
            <ul class="list-group list-group-flush">
                @forelse($facility->services as $s)
                    <li class="list-group-item d-flex">
                        <div>
                            <strong>{{ $s->name }}</strong>
                            <div class="small text-muted">{{ $s->category }} • {{ $s->skill_type }}</div>
                        </div>
                        <a href="{{ route('services.show',$s) }}" class="btn btn-sm btn-outline-secondary ms-auto">View</a>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No services yet.</li>
                @endforelse
            </ul>
            <a href="{{ route('facilities.services.create',$facility) }}" class="btn btn-primary btn-sm mt-3">Add Service</a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card p-4">
            <h5 class="mb-3">Equipment</h5>
            <ul class="list-group list-group-flush">
                @forelse($facility->equipment as $e)
                    <li class="list-group-item d-flex">
                        <div>
                            <strong>{{ $e->name }}</strong>
                            <div class="small text-muted">{{ $e->inventory_code ?? '' }}</div>
                        </div>
                        <a href="{{ route('equipment.show',$e) }}" class="btn btn-sm btn-outline-secondary ms-auto">View</a>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No equipment yet.</li>
                @endforelse
            </ul>
            <a href="{{ route('facilities.equipment.create',$facility) }}" class="btn btn-primary btn-sm mt-3">Add Equipment</a>
        </div>
    </div>
</div>
@endsection
