@extends('layouts.app')
@section('content')
<h1 class="h3 mb-3">Edit Program</h1>
<div class="card p-4">
    <form method="post" action="{{ route('programs.update',$program) }}">
        @method('PUT')
        @include('programs._form', ['program'=>$program])
    </form>
</div>
@endsection
 