@extends('layouts.app')
@section('content')
<div class="card p-4">
    <h2 class="h5">{{ $service->name }}</h2>
    <div class="text-muted">{{ $service->category }} • {{ $service->skill_type }}</div>
    <p class="mt-2">{{ $service->description ?? 'No description.' }}</p>
    <div class="mt-3">
        <a href="{{ route('services.edit',$service) }}" class="btn btn-outline-secondary">Edit</a>
    </div>
</div>
@endsection
