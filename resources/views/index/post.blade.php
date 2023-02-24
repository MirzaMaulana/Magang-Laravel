@extends('index.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="post col-md-8">
                <div class="text-center mt-3">
                    @foreach ($post->category as $category)
                        <small class="d-inline-block me-2">{{ $category->name }}</small>
                    @endforeach
                    <h2>{{ $post->title }}</h2>
                </div>
                {{-- User --}}
                <div class="d-flex justify-content-center my-4">
                    <div class="me-3">
                        @if (Auth::user()->image)
                            <img src="{{ asset('storage/avatars/' . Auth::user()->image) }}"
                                class="img-profile rounded-circle" style="border: 5px solid rgb(247, 247, 247);"
                                height="50" width="50">
                        @else
                            <img src="https://th.bing.com/th/id/OIP.uc7jeY-cjioA7nqy6XkMnwAAAA?pid=ImgDet&rs=1"
                                class="img-profile rounded-circle" height="50" width="50">
                        @endif
                    </div>
                    <div class="">
                        <div class="card-body">
                            <h5 class="card-title">{{ Auth::user()->name }}</h5>
                            <p class="card-text"><small class="text-muted">{{ $post->created_at->format('d F Y') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
                <img src="{{ asset('storage/posts/' . $post->image) }}" alt="" class="post-img">
                <article class="my-3 fs-5">
                    {!! $post->content !!}
                </article>
                @foreach ($post->tag as $tags)
                    <p class="mt-2 d-inline-block text-primary">
                        #{{ $tags->name }}
                    </p>
                @endforeach

                <p><a href="/" class="mt-3 text-decoration-none btn btn-outline-success"><i
                            class="bi bi-box-arrow-left me-2"></i> Back to
                        Posts</a></p>
            </div>
        </div>
    </div>
@endsection
