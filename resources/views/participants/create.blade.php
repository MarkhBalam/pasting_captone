@extends('layouts.app')
@section('content')
<h1 class="h3 mb-3">Add Participant</h1>
<div class="card p-4">
    <form method="post" action="{{ route('participants.store') }}">
        @include('participants._form')
    </form>
</div>
@endsection
