@extends('layouts.app')
@section('content')
<div class="card p-4">
    <h2 class="h5">{{ $outcome->title }}</h2>
    <div class="text-muted mb-2">{{ $outcome->outcome_type }} • {{ $outcome->commercialization_status ?? '—' }}</div>
    <p>{{ $outcome->description ?? 'No description.' }}</p>
    @if($outcome->artifact_link)
        <a class="btn btn-outline-primary" href="{{ $outcome->artifact_link }}" target="_blank">Open artifact</a>
    @endif
</div>
@endsection
