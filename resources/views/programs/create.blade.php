@extends('layouts.app')
@section('content')
<h1 class="h3 mb-3">New Program</h1>
<div class="card p-4">
    <form method="post" action="{{ route('programs.store') }}">
        @include('programs._form')
    </form>
</div>
@endsection
