@extends('layouts.app')
@section('content')
<h1 class="h3 mb-3">Edit Facility</h1>
<div class="card p-4">
    <form method="post" action="{{ route('facilities.update',$facility) }}">
        @method('PUT')
        @include('facilities._form', ['facility'=>$facility])
    </form>
</div>
@endsection
