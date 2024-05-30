@extends('blog.layouts.master')

@section('content')
    {{-- Slider Part --}}

    <div id="carouselExampleSlidesOnly" class="carousel slide mnt" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('blog/blog_images/pexels-taryn-elliott.jpg') }}" style="height: 850px" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('blog/blog_images/train.jpg') }}" style="height: 850px" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('blog/blog_images/snow.jpg') }}" style="height: 850px" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('blog/blog_images/sea.jpg') }}" style="height: 850px" class="d-block w-100">
            </div>
        </div>
    </div>

    {{-- Section & Main Part --}}
    <div class="container">
        {{-- Section Part --}}
        <section class="feature-categories container mt-4">
            <div class="row">

                @foreach ($mostPopularCategories as $category)
                    <div class="col-md-3 p-2" data-aos="fade-down-right" data-aos-duration="1000"
                        data-aos-easing="ease-in-out">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <div style="
                                        background: url('{{ $category->image }}') no-repeat center center;
                                        background-size: cover;
                                        height: 300px"
                                        class="p-4 position-relative">
                                    </div>
                                </div>
                                <div class="flip-card-back px-3" style="height:300px;">
                                    <h3 class="mt-5" style="color: #737070;">{{ $category->name }}</h3>
                                    <p>{{ $category->description }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </section>

        {{-- Main Part --}}
        <main class="mt-5">
            <div class="row">
                <div class="col-md-9">
                    <section class="most-popular row" data-aos="zoom-in-up" data-aos-duration="2000"
                        data-aos-easing="ease-in-out">
                        <div class="popular-title col-md-8">
                            <h2 class="font-montserrat fw-semibold">Top Trending Blogs</h2>
                        </div>
                        <div class="col-4">
                            <div class="most-popular-swiper-navigation text-end">
                                <span
                                    class="btn btn-secondary material-symbols-outlined most-popular-swiper-button-prev">arrow_back</span>
                                <span
                                    class="btn btn-secondary material-symbols-outlined most-popular-swiper-button-next">arrow_forward</span>
                            </div>
                        </div>
                        <!-- Slider main container -->
                        <div class="col-12">
                            <div class="swiper-most-popular mt-3">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    @foreach ($mostPopularBlogs as $blog)
                                        <div class="swiper-slide">
                                            <a href="{{ route('blogs.details', $blog->slug) }}">
                                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                                    class="img-fluid w-100 latest_article_img">
                                            </a>
                                            <div class="most-popular-body mt-2">
                                                <div class="most-popular-author d-flex justify-content-between">
                                                    <div>
                                                        Blogger: <a href="#">{{ $blog->user->name }}</a>
                                                    </div>
                                                    <div class="text-end">Category:
                                                        <a
                                                            href="{{ route('blogs', ['category' => $blog->category->slug]) }}">{{ $blog->category->name }}</a>
                                                    </div>
                                                </div>
                                                <div class="most-popular-title">
                                                    <h4 class="text-black article-h4">
                                                        <a
                                                            href="{{ route('blogs.details', $blog->slug) }}">{!! Str::substr($blog->title, 0, 20) !!}</a>
                                                    </h4>
                                                </div>
                                                <div class="most-popular-date">
                                                    <span>{{ date('d-m-Y', strtotime($blog->created_at)) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="articles row mt-5" data-aos="flip-left" data-aos-duration="2000"
                        data-aos-easing="ease-out-cubic">

                        <div class="popular-title col-md-12">
                            <h2 class="font-montserrat fw-semibold">Our Latest Blogs</h2>
                        </div>

                        @foreach ($latestBlogs as $latestBlog)
                            <div class="col-md-4 mt-4">
                                <div class="article">
                                    <a href="{{ route('blogs.details', $latestBlog->slug) }}">
                                        <img src="{{ asset($latestBlog->image) }}" alt="{{ $latestBlog->title }}"
                                            class="img-fluid w-100 latest_article_img">
                                    </a>
                                    <div class="most-popular-body mt-2">
                                        <div class="most-popular-author d-flex justify-content-between">
                                            <div>
                                                Blogger: <a href="#">{{ $latestBlog->user->name }}</a>
                                            </div>
                                            <div class="text-end">Category:
                                                <a
                                                    href="{{ route('blogs', ['category' => $latestBlog->category->slug]) }}">{{ $latestBlog->category->name }}</a>
                                            </div>
                                        </div>
                                        <div class="most-popular-title">
                                            <h4 class="text-black article-h4">
                                                <a
                                                    href="{{ route('blogs.details', $latestBlog->slug) }}">{!! Str::substr($latestBlog->title, 0, 20) !!}</a>
                                            </h4>
                                        </div>
                                        <div class="most-popular-date">
                                            <span>{{ date('d-m-Y', strtotime($latestBlog->created_at)) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </section>

                    <section class="telegram d-flex align-items-center mt-5 p-4 rounded-2 text-white">
                        <div class="me-4">
                            <span class="material-symbols-outlined text-black">send</span>
                        </div>
                        <div class="telegram-body">
                            <h4>Don't forget to join our Telegram group!</h4>
                            <p>Join our Telegram group that brings together adventurous spirits for new adventures!</p>
                            <a href="https://web.telegram.org/k/" class="btn btn-primary p-3 text-black telegram-btn"
                                target="_blank">Join Telegram</a>
                        </div>
                    </section>

                </div>

                @include('blog.category-part')

            </div>
        </main>
    </div>
@endsection
