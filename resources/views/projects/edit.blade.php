@extends('layouts.app')
@section('content')
<h1 class="h3 mb-3">Edit Project</h1>
<div class="card p-4">
    <form method="post" action="{{ route('projects.update',$project) }}">
        @method('PUT')
        @include('projects._form', ['project'=>$project])
    </form>
</div>
@endsection
