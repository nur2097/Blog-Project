@extends('blog.layouts.user_master')

@section('content')
    <div class="fp_dashboard_body">
        <div class="fp_dash_personal_info">
            <div class="row">
                <h3>Favorite List</h3>

                <div class="fp__dashoard_wishlist">
                    <div class="row">
                        <div class="swiper-favorite-list">
                            <div class="swiper-wrapper">
                                @foreach ($favoriteBlogs as $favorite)
                                    <div class="swiper-slide">
                                        <div class="col-xl-4 col-sm-6 col-lg-6 blog-img">
                                            <div class="fp__menu_item mb">
                                                <div class="fp__menu_item_img">
                                                    <img src="{{ asset($favorite->blog->image) }}" alt="menu"
                                                        class="img-fluid w-100">
                                                    <a class="category"
                                                        href="{{ route('blogs.category', ['slug' => $favorite->blog->category->slug]) }}">{{ $favorite->blog->category->name }}</a>
                                                </div>
                                                <div class="fp__menu_item_text">
                                                    <a class="title"
                                                        href="{{ route('blogs.details', $favorite->blog->slug) }}">{{ $favorite->blog->title }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @if ($favoriteBlogs->count() > 3)
                        <div class="col-6">
                            <div class="favorite-list-swiper-navigation text-end">
                                <span
                                    class="btn material-symbols-outlined favorite-list-swiper-button-prev blog-btn">arrow_back</span>
                                <span
                                    class="btn material-symbols-outlined favorite-list-swiper-button-next blog-btn">arrow_forward</span>
                            </div>
                        </div>
                    @endif

                    @if ($favoriteBlogs->isEmpty())
                        <br>
                        <h5 class="text-center">Favorite Blog Is Not Found!</h5>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const swiper = new Swiper('.swiper-favorite-list', {
            // Optional parameters
            //direction: 'vertical',
            loop: true,

            // Navigation arrows
            navigation: {
                nextEl: '.favorite-list-swiper-button-next',
                prevEl: '.favorite-list-swiper-button-prev',
            },
            speed: 1000,
            spaceBetween: 30,
            slidesPerView: 3,
        });
    </script>
@endpush
