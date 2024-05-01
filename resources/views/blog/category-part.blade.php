<!--Category Part--->
<div class="col-md-3">
    <section class="categories bg-white shadow-sm">
        <h4 class="bg-light text-secondary p-3 border-bottom border-1 border-light m-0">Categories</h4>

        <ul class="list-group m-0">
            @foreach ($categories as $category)
                @if ($category->blogs_count >= 1)
                    <li class="px-3 py-3">
                        <a href="{{ route('blogs.category', ['slug' => $category->slug]) }}">{{ $category->name }}
                            <span class="text-warning float-end me-3">{{ $category->blogs_count }}</span></a>
                    </li>
                @endif
            @endforeach
        </ul>
    </section>

    <section class="youtube-video mt-4">
        <h3 class="font-montserrat fw-semibold">Videos</h3>
        <div class="swiper-youtube">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <iframe width="100%"
                        src="https://www.youtube-nocookie.com/embed/PQWKHVFz5tM?si=izNDwz7hyyd0em33&amp;controls=0"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>

                <div class="swiper-slide">
                    <iframe width="100%"
                        src="https://www.youtube-nocookie.com/embed/BRVRF4g22-g?si=siiTzzpJW6s3Cx0g&amp;controls=0"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>

                <div class="swiper-slide">
                    <iframe width="100%"
                        src="https://www.youtube-nocookie.com/embed/caVxEBHF0vM?si=b0HndbAC9ILLLvlt&amp;controls=0"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>

                <div class="swiper-slide">
                    <iframe width="100%"
                        src="https://www.youtube-nocookie.com/embed/q2OPIaB7gOI?si=TL4yXTaR9pSPVQz6&amp;controls=0"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>

                <div class="swiper-slide">
                    <iframe width="100%"
                        src="https://www.youtube-nocookie.com/embed/UnpoV_Jw4_4?si=6DWRfcksnLGJ4QWS&amp;controls=0"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="most-popular-swiper-navigation text-end">
            <span
                class="youtube-button btn btn-secondary btn-sm material-symbols-outlined youtube-swiper-button-prev">arrow_back</span>
            <span
                class="youtube-button btn btn-secondary btn-sm material-symbols-outlined youtube-swiper-button-next">arrow_forward</span>
        </div>

    </section>

    <section class="authors mt-4">
        <h3 class="font-montserrat fw-semibold">Our Bloggers</h3>
        <div class="swiper-authors">
            <div class="swiper-wrapper">
                @foreach ($blogger as $blog)
                    <div class="swiper-slide">
                        <a href="#">
                            <div
                                style="background-image: url('{{ $blog->user->avatar }}');
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-position: center center;
                                        height: 150px;">
                            </div>
                            <div>
                                {{ $blog->user->name }}
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="most-popular-swiper-navigation text-end">
            <span
                class="youtube-button btn btn-secondary btn-sm material-symbols-outlined authors-swiper-button-prev">arrow_back</span>
            <span
                class="youtube-button btn btn-secondary btn-sm material-symbols-outlined authors-swiper-button-next">arrow_forward</span>
        </div>

    </section>

</div>
