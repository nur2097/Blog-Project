@extends('blog.layouts.master')

@section('content')
    <div class="container">
        <main class="mt-5">
            <div class="row">
                <div class="col-md-11">
                    <section class="articles row">
                        <div>
                            <h3>{{ $category->name }}</h3>
                        </div>

                        @foreach ($category->blogs as $blog)
                            <div class="col-md-4 mt-4">
                                <div class="article">
                                    <a href="{{ route('blogs.details', $blog->slug) }}">
                                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                            class="img-fluid w-100 article_img">
                                    </a>
                                    <div class="most-popular-body mt-2">
                                        <div class="most-popular-author d-flex justify-content-between">
                                            <div>
                                                Blogger: <a href="#">{{ $blog->user->name }}</a>
                                            </div>
                                            <div class="text-end">Category: <a
                                                    href="{{ route('blogs.category', ['slug' => $category->slug]) }}">{{ $blog->category->name }}</a>
                                            </div>
                                        </div>
                                        <div class="most-popular-title">
                                            <h4 class="text-black article-h4">
                                                <a
                                                    href="{{ route('blogs.details', $blog->slug) }}">{!! $blog->title !!}</a>
                                            </h4>
                                        </div>
                                        <div class="most-popular-date">
                                            <span>{{ date('d-m-Y', strtotime($blog->created_at)) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if ($blogs->hasPages())
                            <div class="pagination d-flex justify-content-center mt-60">
                                {{ $blogs->links() }}
                            </div>
                        @endif
                    </section>

                </div>

            </div>
        </main>

    </div>
@endsection
