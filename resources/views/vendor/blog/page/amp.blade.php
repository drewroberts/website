@extends('support::amp')

@section('content')
    @include('blog::page.partials._identity_tag')

    {{-- Place holder content - safe to replace --}}
    <ul>
        <li>Page: {{ $page->name }}</li>
        <li>Child: {{ $child_page->name ?? 'NONE' }}</li>
        <li>Grand Child: {{ $grand_child_page->name ?? 'NONE' }}</li>
    </ul>
@endsection
