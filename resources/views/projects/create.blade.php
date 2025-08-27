@extends('layouts.app')
@section('content')
<h1 class="h3 mb-3">New Project</h1>
<div class="card p-4">
    <form method="post" action="{{ route('projects.store') }}">
        @include('projects._form')
    </form>
</div>
@endsection
