@extends('blog.layouts.master')

@section('og_metatag_section')
    <meta property="og:title" content="{{ $blog->seo_title }}">
    <meta property="og:description" content="{{ $blog->seo_description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset($blog->image) }}">
    <meta property="og:site_name" content="{{ config('settings.site_name') }}">
    <meta property="og:type" content="website">
@endsection

@section('content')
    <div class="container">
        {{-- Main Part --}}
        <main class="mt-5">
            <div class="row">
                <div class="col-md-9">
                    <section class="row">
                        <div class="col-12 bg-white rounded-1 shadow-sm">
                            <div class="article-wrapper">
                                <div class="article-header font-lato pb-4">
                                    <div>
                                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                            class="img-fluid w-100 article_detail_img ">
                                    </div>

                                    <div class="article_detail_d_p">
                                        <span
                                            class="article-header-date">{{ date('d-m-Y', strtotime($blog->created_at)) }}</span>
                                        <p class="article-header-author article_detail_p">
                                            Blogger: <a href="#"><strong>{{ $blog->user->name }}</strong></a>
                                        </p>
                                    </div>

                                    <div class="article-header-date article_detail_span article-header-author">
                                        <span>
                                            <a href="{{ route('blogs.category', ['slug' => $blog->category->slug]) }}">
                                                <strong>{{ $blog->category->name }}</strong></a>
                                        </span>

                                    </div>

                                </div>

                                <div class="article-content mt-4">
                                    <h1 class="fw-bold mb-4">{!! $blog->title !!}</h1>
                                    <div class="text-secondary">
                                        {!! $blog->description !!}
                                    </div>
                                </div>

                            </div>

                        </div>

                        <section class="col-12 mt-4">
                            <div class="article-items d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    @php
                                        $userLike = $blog->articleLikes->where('user_id', auth()->id())->first();
                                    @endphp
                                    <a href="javascript:void(0)" class="favorite-article me-1" id="favoriteArticle"
                                        data-id="{{ $blog->id }}"
                                        @if (!is_null($userLike)) style="color: darkorange" @endif>
                                        <span class="material-symbols-outlined">
                                            <style>
                                                .material-symbols-outlined {
                                                    font-variation-settings:
                                                        'FILL' 1;
                                                }
                                            </style>favorite
                                        </span>
                                    </a>
                                    <span class="fw-light"
                                        id="favoriteCount-{{ $blog->id }}">{{ $blog->like_count }}</span>

                                    <div class="social-icon">
                                        <a class="icon-response"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a class="icon-response"
                                            href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $blog->title }}">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        <a class="icon-response"
                                            href="http://twitter.com/share?text={{ $blog->title }}&url={{ url()->current() }}">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </div>
                                </div>

                                <a href="javascript:void(0)" class="btn-response btnArticleResponse">Add a Comment</a>
                            </div>

                            <div class="blog_det_button mt-5">
                                @if ($nextBlog)
                                    <div class="card blog_det_card">
                                        <a href="{{ route('blogs.details', $nextBlog->slug) }}" class="blog_det_previous">
                                            <img src="{{ asset($nextBlog->image) }}" alt="button img"
                                                class="img-fluid w-100">
                                            <p>{{ $nextBlog->title }} <br>
                                                <span class="previous_span"><i class="fas fa-arrow-left"></i>Previous</span>
                                            </p>
                                        </a>
                                    </div>
                                @endif
                                @if ($previousBlog)
                                    <div class="card blog_det_card">
                                        <a href="{{ route('blogs.details', $previousBlog->slug) }}" class="blog_det_next">
                                            <p>{{ $previousBlog->title }} <br>
                                                <span class="next_span">Next<i class="fas fa-arrow-right"></i></span>
                                            </p>
                                            <img src="{{ asset($previousBlog->image) }}" alt="button img"
                                                class="img-fluid w-100">
                                        </a>
                                    </div>
                                @endif

                            </div>

                            <div class="response-body p-4 mt-5">
                                <h3>Blog Comments</h3>
                                <hr class="mb-4">
                                <form action="">
                                    <div class="article-authors article-response-wrapper">
                                        <h4 class="comment-h4">{{ count($comments) }} Yorum</h4>
                                        @foreach ($comments as $comment)
                                            <div class=" bg-white p-2 mt-3 d-flex align-items-center shadow-sm">
                                                <img src="{{ asset($comment->user->avatar) }}" class="comment-img">
                                                <div class="px-3 comment">
                                                    <div class="d-flex">
                                                        <h4 class="comment-h4">{{ $comment->user->name }}</h4>
                                                        <span
                                                            class="text-secondary comment-date">{{ date('d M Y', strtotime($comment->created_at)) }}</span>
                                                    </div>
                                                    <p class="text-secondary comment-p">{{ $comment->comment }}</p>

                                                    <div
                                                        class="text-end d-flex align-items-center justify-content-between comment-response">
                                                        <div class="d-flex align-items-center">
                                                            @php
                                                                $commentLike = $comment->commentLikes
                                                                    ->where('user_id', auth()->id())
                                                                    ->first();
                                                            @endphp
                                                            <a href="javascript:void(0)" class="like-comment"
                                                                data-id="{{ $comment->id }}"
                                                                @if (!is_null($commentLike)) style="color: darkorange" @endif>
                                                                <span class="material-symbols-outlined">favorite</span></a>
                                                            <span
                                                                id="commentLikeCount-{{ $comment->id }}">{{ $comment->like_count }}</span>
                                                        </div>
                                                        <div class="comment-btn">
                                                            <a href="javascript:void(0)"
                                                                class="btn-response btnArticleResponse"
                                                                data-id="{{ $comment->id }}">Respond</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if ($comments->hasPages())
                                            <div class="pagination mt-60">
                                                <div class="row">
                                                    <div class="col-12">
                                                        {{ $comments->links() }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>

                        </section>

                        <section class="article-responses mt-4">
                            <div class="response-form bg-white shadow-sm rounded-1 p-4" id="newComment"
                                style="display: none">
                                <form action="{{ route('blogs.comment.store', $blog->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5>Comment</h5>
                                            <hr>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <textarea name="comment" cols="30" rows="5" class="form-control" placeholder="Mesajınız"></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="article_btn_response align-items-center d-flex mt-3">
                                                <span class="material-symbols-outlined me-2">send</span>
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </section>
                    </section>

                </div>


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
                </div>
            </div>
        </main>
    </div>
@endsection
