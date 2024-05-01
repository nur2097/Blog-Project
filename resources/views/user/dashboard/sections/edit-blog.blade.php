@extends('blog.layouts.user_blog')

@section('content')
    <section class="section card col-lg-8 card-blog">

        <div class="fp_dash_personal_info">
            <h4>Update Blog
                <a class="dash_info_btn" href="{{ route('user.blogs.index') }}">
                    <span class="cancel">cancel</span>
                </a>
            </h4>
            <hr>
        </div>
        <div class="card-body col-lg-9 create-blog">
            <form action="{{ route('user.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group bottom">
                    <label>Resim</label>
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Dosya Seç</label>
                        <input type="file" name="image" id="image-upload">
                        <input type="hidden" name="old_image" value="{{ $blog->image }}">
                    </div>
                </div>

                <div class="form-group bottom">
                    <label>Başlık</label>
                    <input type="text" class="form-control" name="title" value="{{ $blog->title }}">
                </div>

                <div class="form-group bottom">
                    <label>Kategori</label>
                    <select name="category" class="form-control select2" id="">
                        <option value="">Seç</option>
                        @foreach ($categories as $category)
                            <option @selected($category->id === $blog->category_id) value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group bottom">
                    <label>Açıklama</label>
                    <textarea name="description" class="form-control summernote" style="height: 350px !important;" id="">{!! $blog->description !!}</textarea>
                </div>

                <div class="form-group bottom">
                    <label>Seo Başlık</label>
                    <input type="text" class="form-control" name="seo_title" value="{{ $blog->seo_title }}">
                </div>

                <div class="form-group bottom">
                    <label>Seo Açıklama</label>
                    <textarea name="seo_description" class="form-control" id="">{{ $blog->seo_description }}</textarea>
                </div>

                <div class="form-group bottom">
                    <label>Durum</label>
                    <select name="status" class="form-control" id="">
                        <option @selected($blog->status === 1) value="1">Aktif</option>
                        <option @selected($blog->status === 0) value="0">Aktif Değil</option>
                    </select>
                </div>

                <button type="submit" class="btn-blog">Güncelle</button>
            </form>
        </div>

    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.image-preview').css({
                'background-image': 'url({{ asset($blog->image) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
