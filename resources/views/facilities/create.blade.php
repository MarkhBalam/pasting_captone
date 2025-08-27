@extends('layouts.app')
@section('content')
<h1 class="h3 mb-3">New Facility</h1>
<div class="card p-4">
    <form method="post" action="{{ route('facilities.store') }}">
        @include('facilities._form')
    </form>
</div>
@endsection
