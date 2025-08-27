@extends('layouts.app')
@section('content')
<div class="card p-4">
    <h2 class="h5">{{ $equipment->name }}</h2>
    <div class="text-muted">{{ $equipment->inventory_code ?? '' }}</div>
    <p class="mt-2">{{ $equipment->description ?? 'No description.' }}</p>
    <div class="mt-3">
        <a href="{{ route('equipment.edit',$equipment) }}" class="btn btn-outline-secondary">Edit</a>
    </div>
</div>
@endsection
