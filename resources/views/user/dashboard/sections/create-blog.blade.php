@extends('blog.layouts.user_blog')

@section('content')
    <div class="card col-lg-8 card-blog">
        <div class="fp_dash_personal_info">
            <h4>Create Blog
                <a class="dash_info_btn" href="{{ route('user.blogs.index') }}">
                    <span class="cancel">cancel</span>
                </a>
            </h4>
            <hr>
        </div>
        <div class="col-lg-7 create-blog">
            <form method="POST" action="{{ route('user.blogs.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group bottom">
                    <label for="">Resim</label>
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Dosya Seç</label>
                        <input type="file" name="image" id="image-upload">
                    </div>
                </div>

                <div class="form-group bottom">
                    <label for="">Başlık</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>

                <div class="form-group bottom">
                    <label for="">Kategori</label>
                    <select name="category" class="form-control select2" id="">
                        <option value="">Seç</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group bottom">
                    <label for="">Açıklama</label>
                    <textarea name="description" class="form-control summernote" style="height: 350px !important;" id="">{{ old('description') }}</textarea>
                </div>

                <div class="form-group bottom">
                    <label for="">Seo Başlık</label>
                    <input type="text" class="form-control" name="seo_title" value="{{ old('seo_title') }}">
                </div>

                <div class="form-group bottom">
                    <label for="">Seo Açıklama</label>
                    <textarea name="seo_description" class="form-control" id="">{{ old('seo_description') }}</textarea>
                </div>

                <div class="form-group bottom">
                    <label for="">Durum</label>
                    <select name="status" class="form-control" id="">
                        <option value="1">Aktif</option>
                        <option value="0">Aktif Değil</option>
                    </select>
                </div>

                <button type="submit" class="btn-blog">Oluştur</button>
            </form>
        </div>
    </div>
@endsection
