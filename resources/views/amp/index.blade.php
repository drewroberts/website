@extends('master')

@section('content')

<div class="bg-black bg-opacity-85">
    <div class="cinema max-w-screen-2xl pt-4 pb-4 mx-auto">
        <div class="cinema-screen flex flex-col sm:flex-row">
            <div class="featured-element w-full sm:w-2/3">
                <div class="relative" style="padding-top: 56.25%;">
                    <iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/Bk8881Kv4oU" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            
            @include('amp.tabs')

        </div>
    </div>
</div>

<!-- page content -->
@include('amp.page-content.page')

<!-- add footer -->
@include('global-footer.footer')

@endsection
