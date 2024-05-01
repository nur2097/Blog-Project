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
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/toastr.min.css') }}">

    <title>Control Panel &mdash; {{ config('settings.seo_title') }}</title>
    <link rel="icon" type="image/png" href="{{ asset(config('settings.favicon')) }}">

    <style>
        :root {
            --colorPrimary: {{ config('settings.site_color') }};
        }
    </style>
</head>

<body>

    {{-- <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('blog_images/search_icon.png')}}" alt="" class="search_icon">
        </a> --}}

    {{-- Navbar Part --}}


    <nav class="navbar navbar-expand-lg navbar-light bg-light user-trn">
        <div>
            <a class="user-navbar" href="{{ url('/') }}">
                <img src="{{ asset(config('settings.logo')) }}" class="logo">
            </a>
        </div>
    </nav>

    <!--=========================
        DASHBOARD START
    ==========================-->
    <section class="fp__dashboard mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <div class="fp__dashboard_area">
                <div class="row">

                    @include('user.layouts.sidebar')

                    <div class="col-xl-9 col-lg-8 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__dashboard_content">
                            <div class="tab-content" id="v-pills-tabContent">

                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

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


    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend/js/toastr.min.js') }}"></script>
    <script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });

        $(document).ready(function() {

            $(".dash_info_btn").click(function() {
                $(".fp_dash_personal_info").toggleClass("show");
            });

            $('#upload').on('change', function() {
                let form = $('#avatar_form')[0];
                let formData = new FormData(form);

                $.ajax({
                    method: 'POST',
                    url: "{{ route('profile.avatar.update') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.reload();
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }

                })
            })


            $('body').on('click', '.delete-item', function(e) {
                e.preventDefault()
                let url = $(this).attr('href');

                Swal.fire({
                    title: "Are You Sure You Want to Delete?",
                    text: "You can't take this back!",
                    icon: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete!",
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    toastr.success(response.message)

                                    window.location.reload();
                                } else if (response.status === 'error') {
                                    toastr.error(response.message)
                                }
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        })

                    }
                });
            })

        });
    </script>

    @stack('scripts')
</body>

</html>
