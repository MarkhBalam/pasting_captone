@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center mb-3">
    <h1 class="h3 mb-0">Programs</h1>
    <a href="{{ route('programs.create') }}" class="btn btn-primary ms-auto">New Program</a>
</div>
<div class="card p-3">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Name</th>
                <th>Projects</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse($programs as $pr)
            <tr>
                <td><a href="{{ route('programs.show',$pr) }}" class="text-decoration-none">{{ $pr->name }}</a></td>
                <td>{{ $pr->projects()->count() }}</td>
                <td class="text-end">
                    <a href="{{ route('programs.edit',$pr) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <button type="button" class="btn btn-sm btn-outline-danger"
                            data-delete-url="{{ route('programs.destroy',$pr) }}">
                        Delete
                    </button>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="text-center text-muted">No programs yet.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $programs->links() }}
</div>
@endsection
