@extends('index.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="post col-md-8">
                <div class="text-center mt-3">

                    <h2>{{ $post->title }}</h2>
                </div>
                {{-- User --}}
                <div class="d-flex justify-content-center my-4">
                    <div class="me-3">
                        <img src="https://th.bing.com/th/id/OIP.uc7jeY-cjioA7nqy6XkMnwAAAA?pid=ImgDet&rs=1"
                            class="img-profile rounded-circle" height="50" width="50">
                    </div>
                    <div class="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->created_by }}</h5>
                            <p class="card-text"><small class="text-muted">{{ $post->created_at->format('d F Y') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
                <img src="{{ asset('storage/posts/' . $post->image) }}" alt="" class="post-img">
                <article class="my-3 fs-5">
                    {!! $post->content !!}
                </article>
                <div>
                    @foreach ($post->tag as $tags)
                        <p class=" d-inline-block text-primary">
                            <a href="{{ route('welcome', ['tag' => $tags->name]) }}">#{{ $tags->name }}</a>
                        </p>
                    @endforeach
                </div>
                <div class="my-3">
                    @foreach ($post->category as $category)
                        <small class="d-inline-block me-2"><a class="text-decoration-none p-1 rounded-3 text-dark"
                                href="{{ route('welcome', ['category' => $category->name]) }}"
                                style="border:1px solid black">{{ $category->name }}</a></small>
                    @endforeach
                </div>


                <p><a href="/" class="mt-3 text-decoration-none btn btn-outline-success"><i
                            class="bi bi-box-arrow-left me-2"></i> Back to
                        Posts</a></p>
            </div>
        </div>
    </div>
@endsection
