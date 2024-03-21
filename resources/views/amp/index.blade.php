@extends('master.blade.php')

@section('content')

<div class="cinema bg-gray-900">
    <div class="cinema-screen flex flex-col sm:flex-row">
        <div class="featured-element w-full sm:w-2/3">
            <div class="relative" style="padding-top: 56.25%;">
                <iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/Bk8881Kv4oU" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="playlist-element w-full sm:w-1/3 bg-gray-800 p-4">
            <div class="tabContainer">
                <div role="tab" class="tabButton mb-4 px-4 py-2 bg-gray-700 text-white rounded-t-md">Playlist</div>
                <div role="tabpanel" class="tabContent">
                    <ul class="playlist-rows">
                        <li class="playlist-row mb-4">
                            <a href="/amp/video" class="flex items-center space-x-4">
                                <div class="image__container">
                                    <img src="https://video-images.vice.com/videos/5b/08/5b087695f1cdb37607452231/5b087695f1cdb37607452231-1527610510190.jpg?crop=0.9995494277732719xw%3A1xh%3Bcenter%2Ccenter&amp;resize=650%3A*" alt="Thumbnail" class="w-32 h-16 object-cover rounded">
                                </div>
                                <div class="info">
                                    <div class="series_episode text-xs mb-1">How-To / S5 EP19</div>
                                    <p class="episode_title text-xs">Pizza Pocket with Matty Matheson</p>
                                </div>
                            </a>
                        </li>
                        <!-- Add more list items as needed -->
                    </ul>
                </div>
                <!-- Add more tab panels as needed -->
            </div>
        </div>
    </div>
</div>

@endsection