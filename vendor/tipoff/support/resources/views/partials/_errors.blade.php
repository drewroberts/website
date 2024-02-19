@if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif
