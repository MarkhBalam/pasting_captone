@extends('layouts.app')
@section('content')
<h1 class="h3 mb-3">Outcomes</h1>
<div class="card p-3">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Title</th>
                <th>Project</th>
                <th>Type</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse($outcomes as $o)
            <tr>
                <td><a href="{{ route('outcomes.show',$o) }}" class="text-decoration-none">{{ $o->title }}</a></td>
                <td>{{ optional($o->project)->title ?? '—' }}</td>
                <td>{{ $o->outcome_type }}</td>
                <td>{{ $o->commercialization_status ?? '—' }}</td>
                <td class="text-end">
                    <a href="{{ route('outcomes.edit',$o) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <button type="button" class="btn btn-sm btn-outline-danger" data-delete-url="{{ route('outcomes.destroy',$o) }}">Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">No outcomes yet.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $outcomes->links() }}
</div>
@endsection
