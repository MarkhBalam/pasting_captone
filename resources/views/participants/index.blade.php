@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center mb-3">
    <h1 class="h3 mb-0">Participants</h1>
    <a href="{{ route('participants.create') }}" class="btn btn-primary ms-auto">Add Participant</a>
</div>

<div class="card p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Project</th>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($participants as $pt)
                <tr>
                    <td>
                        <a class="text-decoration-none" href="{{ route('participants.show',$pt) }}">
                            {{ $pt->full_name }}
                        </a>
                    </td>
                    <td>{{ $pt->email }}</td>
                    <td>{{ optional($pt->project)->title ?? '—' }}</td>
                    <td>{{ $pt->role_on_project ?? '—' }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('participants.edit',$pt) }}">Edit</a>
                        <button type="button" class="btn btn-sm btn-outline-danger" data-delete-url="{{ route('participants.destroy',$pt) }}">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No participants yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $participants->links() }}
</div>
@endsection
