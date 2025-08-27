@extends('layouts.app')
@section('content')
<h1 class="h5 mb-3">Edit Equipment</h1>
<div class="card p-4">
    <form method="post" action="{{ route('equipment.update',$equipment) }}">
        @method('PUT') @csrf
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Name</label><input name="name" class="form-control" value="{{ old('name',$equipment->name) }}" required></div>
            <div class="col-md-6"><label class="form-label">Inventory code</label><input name="inventory_code" class="form-control" value="{{ old('inventory_code',$equipment->inventory_code) }}"></div>
            <div class="col-12"><label class="form-label">Capabilities</label><textarea name="capabilities" class="form-control" rows="2">{{ old('capabilities',$equipment->capabilities) }}</textarea></div>
            <div class="col-6"><label class="form-label">Usage domain</label><input name="usage_domain" class="form-control" value="{{ old('usage_domain',$equipment->usage_domain) }}"></div>
            <div class="col-6"><label class="form-label">Support phase</label><input name="support_phase" class="form-control" value="{{ old('support_phase',$equipment->support_phase) }}"></div>
            <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description',$equipment->description) }}</textarea></div>
        </div>
        <button class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('equipment.show',$equipment) }}" class="btn btn-link">Cancel</a>
    </form>
</div>
@endsection
