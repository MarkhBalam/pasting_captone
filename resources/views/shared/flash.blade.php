@if(session('status'))
    <div class="alert alert-success rounded-4">{{ session('status') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger rounded-4">
        <strong>Check the form.</strong>
        <ul class="mb-0">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif
