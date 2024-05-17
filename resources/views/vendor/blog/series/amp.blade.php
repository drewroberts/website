@extends('support::amp')

@section('content')
    @include('blog::series.partials._identity_tag')

    {{-- Place holder content - safe to replace --}}
    <ul>
        <li>Topic: {{ $topic->name }}</li>
        <li>Series: {{ $series->name }}</li>
    </ul>
@endsection
