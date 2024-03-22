<div class="slider-container">
    <div class="slider-wrapper">
        <div class="header text-lg font-bold mr-3">
            <section>
                <h3 class="font-bold text-3xl uppercase">AMP Quick Tips</h3>
            </section>
        </div>

        <hr class="border-black border-t-2 my-4">

        <div class="carousel-container">
            <div class="carousel flex flex-no-wrap overflow-x-auto" style="height: auto; min-width: 100%;"> <!-- Set height:auto and min-width:100% -->
                <!-- Loop starts here -->
                @for ($i = 1; $i <= 5; $i++)
                    <div class="slick-slide">
                        <a href="/amp/video" class="flex flex-col mr-4"> <!-- Add margin between slides -->
                            <div class="small">
                                <img class="w-full h-48" src="https://video-images.vice.com/videos/58/24/5824c86f12339f6b5f81aee0/5824c86f12339f6b5f81aee0-1530296289302.jpg?crop=1xw%3A0.9990749306197965xh%3Bcenter%2Ccenter&amp;resize=650%3A*" alt="Image"></img>
                                <div class="flex pt-2 pb-2">
                                    <div class="text-xs">44:10</div>
                                </div>
                            </div>
                            <div class="slider__meta">
                                <div class="text-xs mb-1 font-bold"><span>TATTOO AGE / S1 EP{{ $i }}</span></div>
                                <h6 class="font-bold description flex-grow">New York City Tattoo Legend: Thom DeVita</h6>
                            </div>
                        </a>
                    </div>
                @endfor
                <!-- Loop ends here -->
            </div>
        </div>
    </div>
</div>
