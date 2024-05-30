<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ config('settings.seo_description') }}">
    <meta name="keywords" content="{{ config('settings.seo_keywords') }}">

    @yield('og_metatag_section')

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/css/article-style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/toastr.min.css') }}">

    <title>{{ config('settings.seo_title') }}</title>
    <link rel="icon" type="image/png" href="{{ asset(config('settings.favicon')) }}">

</head>

<body>

    {{-- <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('blog_images/search_icon.png')}}" alt="" class="search_icon">
        </a> --}}

    {{-- Navbar Part --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light trn">
        <div class="nav-logo">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset(config('settings.logo')) }}" class="logo">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-collap">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blogs') }}">Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('aboutUs') }}">About Us</a>
                </li>
            </ul>
        </div>
        <div class="nav-select nav-login">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        @if (Auth::user())
                            <div class="">
                                <img src="{{ auth()->user()->avatar }}" alt="user" class="img-fluid logo-img">
                            </div>
                        @else
                            <i class="fas fa-user" style="font-size: xx-large;"></i>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </nav>


    @yield('content')


    {{-- Footer Part --}}

    @php
        $footerInfo = \App\Models\FooterInfo::first();
    @endphp

    <footer class="card footer">
        <div class="footer-left col-4">
            <img src="{{ asset(config('settings.footer_logo')) }}" class="footer-logo">
            <br>
            <span>{{ $footerInfo->short_info }}</span>
            <br>
            <br>
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram-square fa-lg"></i></a>
            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
            <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter-square fa-lg"></i></a>
            <a href="https://web.telegram.org/k/" target="_blank"><i class="fab fa-telegram fa-lg"></i></a>

        </div>
        <div class="footer-right col-2">
            <a href="callto:{{ $footerInfo->phone }}"><i class="fas fa-phone-alt"></i>
                &nbsp;{{ $footerInfo->phone }}</a>
            <br>
            <a href="mailto:{{ $footerInfo->email }}"><i class="fas fa-envelope"></i>
                &nbsp;{{ $footerInfo->email }}</a>
            <p class="footer-p "><i class="fas fa-map-marker-alt"></i> {{ $footerInfo->address }}</p>
        </div>
        <hr>
        <div class="footer-copy">
            <p>{{ $footerInfo->copyright }}</p>
        </div>
    </footer>

    <div class="position-fixed scroll-to-top btn btn-secondary btn-circle">
        <i class="fa fa-chevron-up"></i>
    </div>

    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend/js/toastr.min.js') }}"></script>

    <script>
        AOS.init();
    </script>

    <script>
        toastr.options.progressBar = true;

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        $(document).ready(function() {

            const swiper = new Swiper('.swiper-most-popular', {
                // Optional parameters
                //direction: 'vertical',
                loop: true,

                // Navigation arrows
                navigation: {
                    nextEl: '.most-popular-swiper-button-next',
                    prevEl: '.most-popular-swiper-button-prev',
                },
                speed: 1000,
                spaceBetween: 30,
                slidesPerView: 3,
            });
            const youtube = new Swiper('.swiper-youtube', {
                loop: true,
                speed: 1000,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.youtube-swiper-button-next',
                    prevEl: '.youtube-swiper-button-prev',
                },
            });
            const authors = new Swiper('.swiper-authors', {
                loop: true,
                speed: 1000,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.authors-swiper-button-next',
                    prevEl: '.authors-swiper-button-prev',
                },
            });

            $('.btnArticleResponse').click(function() {
                let commentID = $(this).data('id');

                $('#comment_parent_id').val(commentID);

                $('.response-form').toggle();

                $('html, body').animate({
                    scrollTop: $('#newComment').offset().top
                }, 100);

            });

            $('#favoriteArticle').click(function() {
                @if (Auth::check())
                    let blogID = $(this).data('id');
                    console.log(blogID);
                    let self = $(this);
                    $.ajax({
                        method: "POST",
                        url: "{{ route('blogs.favorite') }}",
                        data: {
                            id: blogID
                        },
                        async: false,
                        success: function(data) {
                            if (data.process) {
                                self.css("color", "darkorange");
                            } else {
                                self.css("color", "inherit");
                            }

                            $("#favoriteCount").text(data.like_count);
                        },
                        error: function() {
                            console.log('error');
                        }
                    })
                @else
                    toastr.error("Please log in first to add to favorites!")
                @endif
            });

            $('.like-comment').click(function() {
                @if (Auth::check())
                    let blogID = $(this).data('id');
                    console.log(blogID);
                    let self = $(this);
                    $.ajax({
                        method: "POST",
                        url: "{{ route('blogs.comment.favorite') }}",
                        data: {
                            id: blogID
                        },
                        async: false,
                        success: function(data) {
                            if (data.process) {
                                self.css("color", "darkorange");
                            } else {
                                self.css("color", "inherit");
                            }

                            $("#commentLikeCount-" + blogID).text(data.like_count);
                        },
                        error: function() {
                            console.log('error');
                        }
                    })
                @else
                    toastr.error("Please log in first to like the comment!")
                @endif
            });

            $(window).scroll(function (){
                if($(window).scrollTop() > 250){
                    $(".scroll-to-top").css("display", "block");
                }
                else {
                    $(".scroll-to-top").css("display", "none");
                }
            });

            $(".scroll-to-top").click(function(){
                $("html, body").animate({
                    scrollTop:$("body").offset().top
                }, 50);
            });

        });
    </script>
</body>

</html>
