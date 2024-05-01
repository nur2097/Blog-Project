@extends('blog.layouts.user_master')

@section('content')
    <div class="fp_dashboard_body">
        <div class="fp_dash_personal_info">
            <div class="row">
                <h4 class="user_blog">Blogs
                    <a class="dash_info_btn user_create_blog" href="{{ route('user.blogs.create') }}">
                        <span class="edit">Create Blog</span>
                        <span class="cancel">cancel</span>
                    </a>
                </h4>

                <div class="swiper-blog-list">
                    <div class="swiper-wrapper">
                        @foreach ($blogList as $blog)
                            <div class="swiper-slide">
                                <div class="col-xl-4 col-sm-6 col-lg-6 blog-img">
                                    <div class="fp__menu_item mb">
                                        <div class="fp__menu_item_img">
                                            <img src="{{ asset($blog->image) }}" alt="menu" class="img-fluid w-100">
                                            <a class="category" href="{{ route('blogs.category', ['slug' => $blog->category->slug]) }}">{{ $blog->category->name }}</a>
                                        </div>
                                        <div class="fp__menu_item_text">
                                            <a class="title"
                                                href="{{ route('blogs.details', $blog->slug) }}">{{ $blog->title }}</a>
                                            <div class="mt-4">
                                                <a href="{{ route('user.blogs.edit', $blog->id) }}"
                                                    class="btn edit-btn-primary"
                                                    style="background-color: orange;width: 39px;
                                                            height: 37px;"><i
                                                        class="fas fa-edit"></i></a>
                                                <a href="{{ route('user.blogs.destroy', $blog->id) }}"
                                                    class="btn btn-danger delete-item ml-2"
                                                    style="width: 39px;
                                                                height: 37px;"><i
                                                        class="fas fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if ($blogList->count() > 3)
                    <div class="col-6">
                        <div class="blog-list-swiper-navigation text-end">
                            <span
                                class="btn material-symbols-outlined blog-list-swiper-button-prev blog-btn">arrow_back</span>
                            <span
                                class="btn material-symbols-outlined blog-list-swiper-button-next blog-btn">arrow_forward</span>
                        </div>
                    </div>
                @endif

                @if ($blogList->isEmpty())
                    <br>
                    <h5 class="text-center">Blog Is Not Found!</h5>
                @endif



            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const swiper = new Swiper('.swiper-blog-list', {
            // Optional parameters
            //direction: 'vertical',
            loop: true,

            // Navigation arrows
            navigation: {
                nextEl: '.blog-list-swiper-button-next',
                prevEl: '.blog-list-swiper-button-prev',
            },
            speed: 1000,
            spaceBetween: 30,
            slidesPerView: 3,
        });
    </script>
@endpush
