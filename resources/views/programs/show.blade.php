@extends('layouts.app')
@section('content')
<div class="card p-4">
    <h2 class="h4 mb-1">{{ $program->name }}</h2>
    <p class="text-muted">{{ $program->national_alignment }}</p>
    <p>{{ $program->description }}</p>
    <hr>
    <h6 class="text-muted">Projects</h6>
    <ul class="list-group list-group-flush">
        @foreach($program->projects as $p)
            <li class="list-group-item"><a href="{{ route('projects.show',$p) }}">{{ $p->title }}</a></li>
        @endforeach
    </ul>
</div>
@endsection
