@if ($errors->has($field))
    <p class="alert alert-danger">
        {{ $errors->first($field) }}
    </p>    
@endif
