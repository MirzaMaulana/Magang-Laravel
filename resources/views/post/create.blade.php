@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Create Post') }}</div>
                    <div class="card-body">
                        <form action="{{ route('post.input') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- title --}}
                            <div class="row mb-3">
                                <label for="title"
                                    class="col-md-4 col-form-label text-md-end">{{ __('title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title') }}" name="title">

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
                                    class="col-md-4 col-form-label text-md-end">{{ __('slug') }}</label>

                                <div class="col-md-6">
                                    <input id="slug" type="text"
                                        class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}"
                                        name="slug" readonly>

                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Images --}}
                            <div class="row mb-3">
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-end">{{ __('image') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file"
                                        class="form-control @error('image') is-invalid @enderror" name="image">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="row mb-3">
                                <label for="content"
                                    class="col-md-4 col-form-label text-md-end">{{ __('content') }}</label>
                                <div class="col-md-6">
                                    <input id="content" type="hidden"
                                        class="form-control @error('content') is-invalid @enderror" name="content"
                                        value="" autocomplete="off" autofocus>
                                    <textarea id="summernote" input="content" name="content" value="{{ old('description') }}"></textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Category --}}
                            <div class="row mb-3">
                                <label for="category"
                                    class="col-md-4 col-form-label text-md-end">{{ __('category') }}</label>
                                <div class="col-md-6 mt-2">
                                    @foreach ($categories as $category)
                                        <div class="btn-group form-check-inline" role="group"
                                            aria-label="Basic checkbox toggle button group">
                                            <input type="checkbox" name="categories[]" class="btn-check"
                                                id="categories_{{ $category->id }}" autocomplete="off"
                                                value="{{ old('category', $category->id) }}">
                                            <label class="btn btn-sm btn-outline-success me-1"
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
                                    class="col-md-4 col-form-label text-md-end">{{ __('Tag') }}</label>
                                <div class="col-md-6 mt-2">
                                    <div class="form-check form-check-inline">
                                        @foreach ($tags as $tag)
                                            <input class="form-check-input mx-2" type="checkbox" name="tags[]"
                                                id="tag_{{ $tag->id }}" value="{{ $tag->id }}">
                                            <label class="form-check-label"
                                                for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                                        @endforeach
                                    </div>
                                    @error('tags')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            {{-- Save --}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark">
                                        {{ __('Create Post') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#summernote').summernote({
            placeholder: 'Content Post',
            tabsize: 2,
            height: 100
        });
    </script>
    <script src="{{ asset('js/submit.js') }}"></script>
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
    </script>
@endsection
