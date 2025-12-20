@extends('support::base')

@section('content')
    @include('blog::topic.partials._identity_tag')

    {{-- Place holder content - safe to replace --}}
    <ul>
        <li>Topic: {{ $topic->name }}</li>
    </ul>
@endsection
