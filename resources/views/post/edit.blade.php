@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Update Post') }}</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            {{-- title --}}
                            <div class="row mb-3">
                                <label for="title"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ old('title', $post->title) }}">

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- slug --}}
                            <div class="row mb-3">
                                <label for="slug"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Slug') }}</label>

                                <div class="col-md-6">
                                    <input id="slug" type="text"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug', $post->slug) }}" name="slug" readonly>

                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- ispinned  --}}
                            <div class="row mb-3">
                                <label for="is_pinned"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Pin') }}</label>

                                <div class="col-md-6">
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" name="is_pinned" id="is_pinned1"
                                            value="1" value="{{ old('is_pinned', $post->is_pinned) }}"
                                            {{ $post->is_pinned == 1 ? 'checked' : '' }} autocomplete="off">
                                        <label class="btn rounded-4 btn-outline-success me-2"
                                            for="is_pinned1">Pinned</label>

                                        <input type="radio" class="btn-check" name="is_pinned" id="is_pinned2"
                                            value="0" value="{{ old('is_pinned', $post->is_pinned) }}"
                                            {{ $post->is_pinned == 0 ? 'checked' : '' }} autocomplete="off">
                                        <label class="btn rounded-4 btn-outline-warning" for="is_pinned2">No Pin</label>

                                    </div>

                                    @error('is_pinned')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Images --}}
                            <div class="row mb-3">
                                <label for="image"
                                    class="col-md-4 col-form-label mt-4 text-md-end">{{ __('Image') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="image" type="file" onchange="loadFile(event)"
                                            class="form-control mt-3 @error('image') is-invalid @enderror" name="image">
                                        @if ($post->image)
                                            <img id="post" src="{{ asset('storage/posts/' . $post->image) }}"
                                                class="img-thumbnail mx-2" width="100">
                                        @endif
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Content --}}
                            <div class="row mb-3">
                                <label for="content"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Content') }}</label>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-md-6">
                                    <input id="content" type="hidden"
                                        class="form-control @error('content') is-invalid @enderror" name="content"
                                        value="{{ old('content', $post->content) }}" autocomplete="off" autofocus>
                                    <textarea id="summernote" input="content" name="content">{{ old('content', $post->content) }}</textarea>
                                </div>
                            </div>
                            {{-- Category --}}
                            <div class="row mb-3">
                                <label for="category"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Categories') }}</label>
                                <div class="col-md-6 mt-2">

                                    @foreach ($categories as $category)
                                        <div class="btn-group form-check-inline" role="group"
                                            aria-label="Basic checkbox toggle button group">
                                            <input type="checkbox" name="categories[]" class="btn-check"
                                                id="categories_{{ $category->id }}" autocomplete="off"
                                                value="{{ old('category', $category->id) }}"
                                                {{ in_array($category->id, $post->category->pluck('id')->toArray()) ? 'checked' : '' }}>
                                            <label class="btn btn-sm rounded-3 btn-outline-success"
                                                for="categories_{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                    @error('categories')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            {{-- Tag --}}
                            <div class="row mb-3">
                                <label for="tag"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Tags') }}</label>
                                <div class="col-md-6 mt-2">

                                    @foreach ($tags as $tag)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input mx-2" type="checkbox" name="tags[]"
                                                id="tag_{{ $tag->id }}" value="{{ old('tag', $tag->id) }}"
                                                {{ in_array($tag->id, $post->tag->pluck('id')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="tag_{{ $tag->id }}">#{{ $tag->name }}</label>
                                        </div>
                                    @endforeach

                                    @error('tags')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            {{-- Save --}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark">
                                        {{ __('Update Post') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/submit.js') }}"></script>
    <script>
        $('#summernote').summernote({
            placeholder: 'Content',
            tabsize: 2,
            height: 100
        });
    </script>
    <script>
        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        }

        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');
        title.addEventListener('change', function() {
            fetch('/post/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });


        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })
        title.addEventListener('input', function() {
            const slugValue = slugify(title.value);
            slug.value = slugValue;
        });
        let loadFile = function(event) {
            var image = document.getElementById('post');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>

    <script src="{{ asset('js/delete.js') }}"></script>
@endsection
