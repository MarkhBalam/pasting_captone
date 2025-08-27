@extends('layouts.app')
@section('content')
<h1 class="h3 mb-3">Edit Participant</h1>
<div class="card p-4">
    <form method="post" action="{{ route('participants.update',$participant) }}">
        @method('PUT')
        @include('participants._form', ['participant'=>$participant])
    </form>
</div>
@endsection
