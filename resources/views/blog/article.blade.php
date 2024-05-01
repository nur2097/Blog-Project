@extends('blog.layouts.master')

@section('content')
    <div class="container">
        <div class="card search-card">
            <form class="row row-cols-lg-auto g-3 align-items-center search-form" action="{{ route('blogs') }}" method="GET">
                <div class="col-12">
                    <div class="input-group">
                        <input type="text" class="form-control search-select" placeholder="Search" name="search"
                            value="{{ @request()->search }}">
                        <button type="submit" class="btn-search-response">
                            <span class="material-symbols-outlined search-icon1">search</span>
                        </button>
                    </div>
                </div>

                <div class="col-12">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle search-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('blogs.category', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>



            </form>
        </div>

        {{-- Main Part --}}
        <main class="mt-5">
            <div class="row">
                <div class="col-md-11">
                    <section class="articles row">
                        @foreach ($blogs as $blog)
                            <div class="col-md-4 mt-4">
                                <div class="article">
                                    <a href="{{ route('blogs.details', $blog->slug) }}" class="">
                                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                            class="img-fluid w-100 article_img">
                                    </a>
                                    <div class="most-popular-body mt-2">
                                        <div class="most-popular-author d-flex justify-content-between">
                                            <div>
                                                Blogger: <a href="#">{{ $blog->user->name }}</a>
                                            </div>
                                            <div class="text-end">Category: <a
                                                    href="{{ route('blogs.category', ['slug' => $blog->category->slug]) }}">{{ $blog->category->name }}</a>
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

                        @if ($blogs->isEmpty())
                            <h5 class="text-center">No Blog Found!</h5>
                        @endif

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
