<div class="playlist-element w-full sm:w-1/3 bg-black p-4">
    <div class="tabContainer">

        <!-- Tab headings -->
        <div class="tabButtons flex w-full">
            <!-- Playlist Tab -->
            <div role="tab" class="tabButton px-4 py-2 text-white uppercase w-full" aria-controls="playlistTab">Playlist</div>

            <!-- Trending Tab -->
            <div role="tab" class="tabButton px-4 py-2 text-white uppercase w-full" aria-controls="trendingTab">Trending</div>
        </div>

        <!-- Playlist TabContent  -->
        <div id="playlistTab" role="tabpanel" class="tabContent w-full">
            <ul class="playlist-rows">
                @for ($i = 0; $i < 6; $i++) 
                <li class="playlist-row mb-4">
                    <a href="/amp/video" class="flex items-center space-x-4">
                        <div class="image__container">
                            <img src="https://video-images.vice.com/videos/5b/08/5b087695f1cdb37607452231/5b087695f1cdb37607452231-1527610510190.jpg?crop=0.9995494277732719xw%3A1xh%3Bcenter%2Ccenter&amp;resize=650%3A*" alt="Thumbnail" class="w-32 h-16 object-cover rounded">
                        </div>
                        <div class="info">
                            <div class="series_episode text-xs text-gray-400 mb-1">How-To / S5 EP19</div>
                            <p class="episode_title text-xs text-white">Pizza Pocket with Matty Matheson</p>
                        </div>
                    </a>
                </li>
                @endfor
            </ul>
        </div>

        <!-- Trending Tab Content-->
        <div id="trendingTab" role="tabpanel" class="tabContent w-full hidden">
            <ul class="playlist-rows">
                @for ($i = 0; $i < 6; $i++) 
                <li class="playlist-row mb-4">
                    <a href="/amp/video" class="flex items-center space-x-4">
                        <div class="image__container">
                            <img src="https://video-images.vice.com/videos/5b/08/5b087695f1cdb37607452231/5b087695f1cdb37607452231-1527610510190.jpg?crop=0.9995494277732719xw%3A1xh%3Bcenter%2Ccenter&amp;resize=650%3A*" alt="Thumbnail" class="w-32 h-16 object-cover rounded">
                        </div>
                        <div class="info">
                            <div class="series_episode text-xs text-gray-400 mb-1">How-To / S5 EP19</div>
                            <p class="episode_title text-xs text-white">Pizza Pocket with Matty Matheson</p>
                        </div>
                    </a>
                </li>
                @endfor
            </ul>
        </div>
    </div>
</div>

@include('amp.partials.tabs-css')
@include('amp.partials.tabs-js')
