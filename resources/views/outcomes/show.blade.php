@extends('layouts.app')
@section('content')
<div class="card p-4">
    <h2 class="h5">{{ $outcome->title }}</h2>
    <div class="text-muted mb-2">{{ $outcome->outcome_type }} • {{ $outcome->commercialization_status ?? '—' }}</div>
    <p>{{ $outcome->description ?? 'No description.' }}</p>
    
    @if($outcome->artifact_link)
        <a class="btn btn-outline-primary" href="{{ $outcome->artifact_link }}" target="_blank">Open artifact</a>
    @endif

    <div class="mt-3">
        <a href="{{ route('outcomes.edit',$outcome) }}" class="btn btn-outline-secondary">Edit</a>
        <button type="button" class="btn btn-outline-danger" data-delete-url="{{ route('outcomes.destroy',$outcome) }}">Delete</button>
    </div>
</div>
@endsection
