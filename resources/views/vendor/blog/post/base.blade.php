@extends('support::base')

@section('content')
    @include('blog::post.partials._identity_tag')

    {{-- Place holder content - safe to replace --}}
    <ul>
        <li>Topic: {{ $topic->name ?? 'NONE' }}</li>
        <li>Series: {{ $series->name ?? 'NONE' }}</li>
        <li>Post: {{ $post->name }}</li>
    </ul>
@endsection
